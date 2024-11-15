<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use App\Models\StockTransactions;
use App\Models\User;
use App\Services\Product\ProductService;
use App\Services\StockTransactions\StockTransactionsService;
use App\Services\User\UserService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StockTransactionsController extends Controller
{
    private $stokService;
    private $userService;
    private $productService;

    public function __construct(StockTransactionsService $stokService, ProductService $productService, UserService $userService)
    {
        $this->stokService = $stokService;
        $this->userService = $userService;
        $this->productService = $productService;
    }

    public function list(Request $request)
    {
        $products = Product::all();
        $users = User::all();
        $stok = $this->stokService->getAll(); // Get all stock transactions
        $minQuantity = $this->getMinQuantity();
        $maxQuantity = $this->getMaxQuantity(); 

        $selectedMonth = $request->query('month');
        $weeks = [];

        if ($selectedMonth) {
            $selectedMonth = \Carbon\Carbon::parse($selectedMonth);
            $weeks = $this->stokService->generateWeeksInMonth($selectedMonth); // Generate weeks in month
            $stok = $this->stokService->getByMonth($selectedMonth); // Filter by selected month
        }

        return view('stoks.list', compact('stok', 'products', 'users', 'weeks', 'selectedMonth', 'minQuantity', 'maxQuantity'));
    }

    public function opnameStok(){

        $users = $this->userService->getAll();
        $user = Auth::user();
        $userName = $user->name;
        $products = $this->productService->getProductList();
        $reqIn = $this->stokService->requestIn();
        $reqOut = $this->stokService->requestOut();

        return view('role-job.staff.stok.list-stok', compact('products', 'users', 'reqIn', 'reqOut', 'userName'));
    }

    public function updateQuantities(Request $request)
    {
        return $this->stokService->updateOrCreateQuantity($request);
    }

    protected function getMinQuantity()
    {
        return (int) Setting::where('key', 'min_quantity')->value('value') ?? 1; // Default ke 1 jika tidak ada
    }

    protected function getMaxQuantity()
    {
        return (int) Setting::where('key', 'max_quantity')->value('value') ?? 100; // Default ke 1 jika tidak ada
    }

    public function store(Request $request){
        try {
            $this->stokService->store($request->all());
            return redirect()->back()->with('success', 'Stock transaction created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit($id){
        $transaction = $this->stokService->find($id); // Ambil pengguna berdasarkan ID
        return view('stoks.edit', compact('transaction'));
    }
    
    public function editOp($id){
        $transaction = $this->stokService->find($id); // Ambil pengguna berdasarkan ID
        $user = Auth::user();
        $userName = $user->name;
        return view('dashboard.activities.request', compact('transaction','userName'));
    }

    public function update( Request $request, $id ) {
        $data = $request->only(['type','status', 'quantity', 'notes']);
        $this->stokService->updateStok( $id, $data );
        return redirect()->route( 'stok.list' )->with('success', 'Update Stok Successfully.');
    }

    public function opname( Request $request, $id ) {
        $data = $request->only(['type','status', 'user_id', 'quantity']);
        $this->stokService->updateStok( $id, $data );
        return redirect()->route( 'staff.tes' )->with('success', 'Update Stok Successfully.');
    }

    public function exportPDF(Request $request)
    {
        // Validasi input bulan
        $request->validate([
            'month' => 'required|date_format:Y-m', // Pastikan bulan diisi dan memiliki format yang benar
        ], [
            'month.required' => 'Silakan pilih bulan untuk mengekspor.',
            'month.date_format' => 'Format bulan tidak valid. Harus dalam format YYYY-MM.',
        ]);
    
        // Ambil bulan dari request
        $month = $request->input('month');
    
        // Mengambil tahun dan bulan
        list($year, $month) = explode('-', $month);
        
        // Mendapatkan tanggal awal dan akhir bulan
        $startDate = \Carbon\Carbon::createFromDate($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();
    
        // Ambil transaksi stok dalam periode bulan yang dipilih
        $stok = StockTransactions::with(['product', 'user'])
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
    
        $data = [
            'stok' => $stok,
            'image' => public_path('images/logo.png') // Path ke gambar
        ];
    
        // Load view dengan data stok
        $pdf = PDF::loadView('stoks.report', $data);
        return $pdf->stream();
    }

    public function stokIn()
    {
        $stokMasuk = $this->stokService->getByType('Masuk');
        return view('stoks.type.masuk', compact('stokMasuk'));
    }

    public function stokOut()
    {
        $stokKeluar = $this->stokService->getByType('Keluar');
        return view('stoks.type.keluar', compact('stokKeluar'));
    }

    //Laporan Berdasarkan Masuk / Keluar
    public function exportType($type)
    {
        // Validasi tipe transaksi yang diminta
        if (!in_array($type, ['Masuk', 'Keluar'])) {
            abort(404);
        }

        // Ambil data transaksi berdasarkan tipe
        $transactions = StockTransactions::where('type', $type)->get();

        // Load view dan passing data transaksi
        $pdf = PDF::loadView('stoks.export-type', compact('transactions', 'type'));

        // Return PDF sebagai download
        return $pdf->stream('Laporan_Stock_Transaksi_' . $type . '.pdf');
    }
    
    
}
