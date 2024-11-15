<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use App\Models\StockTransactions;
use App\Models\UserActivity;
use App\Services\Product\ProductService;
use App\Services\StockTransactions\StockTransactionsService;
use App\Services\User\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    private $userService;
    private $productService;
    private $stokService;

    public function __construct(UserService $userService, ProductService $productService, StockTransactionsService $stokService)
    {
        $this->userService = $userService;
        $this->productService = $productService;
        $this->stokService = $stokService;
    }

    public function dashboard()
    {
        $user = $this->userService->getAll();
        $product = $this->productService->getProductList();
        $productCount = $this->productService->getCount();
        $activities = UserActivity::with('user')->latest()->get();
        $stokMenipis = StockTransactions::where('quantity', '<=', 10)->paginate(3);
        $stokTipis = StockTransactions::where('quantity', '<=', 10)->get();
        $stokMasuk = $this->stokService->getStokToday();
        $stokKeluar = $this->stokService->getStokOutToday();
        $month = Carbon::now()->month; // Bulan saat ini
        $year = Carbon::now()->year;   // Tahun saat ini
        $settingsLogo = Setting::getLogo();

        // Hitung jumlah transaksi stok untuk bulan saat ini
        $stokTransaksiMasuk = $this->countStockTransactionsMasuk($month, $year);
        $stokTransaksiKeluar = $this->countStockTransactionsKeluar($month, $year);
        // $settingsLogo = $this->showSettings();

        return view('dashboard.admin', compact('product', 'user', 'productCount', 'activities', 'stokMasuk', 'stokKeluar', 'stokMenipis', 'stokTipis', 'stokTransaksiMasuk', 'stokTransaksiKeluar', 'settingsLogo'));
    }

    public function countStockTransactionsMasuk($month, $year)
    {
        // Jika tidak ada nilai $month dan $year, default ke bulan dan tahun saat ini
        $month = $month ?? Carbon::now()->month;
        $year = $year ?? Carbon::now()->year;

        // Menghitung jumlah transaksi stok berdasarkan bulan dan tahun tertentu
        $totalTransactionsMasuk = StockTransactions::whereMonth('date', $month)
                                            ->whereYear('date', $year)
                                            ->where('type', 'Masuk')
                                            ->count();

        return $totalTransactionsMasuk;
    }

    public function countStockTransactionsKeluar($month, $year)
    {
        // Jika tidak ada nilai $month dan $year, default ke bulan dan tahun saat ini
        $month = $month ?? Carbon::now()->month;
        $year = $year ?? Carbon::now()->year;

        // Menghitung jumlah transaksi stok berdasarkan bulan dan tahun tertentu
        $totalTransactionsMasuk = StockTransactions::whereMonth('date', $month)
                                            ->whereYear('date', $year)
                                            ->where('type', 'Keluar')
                                            ->count();

        return $totalTransactionsMasuk;
    }

    public function manajer()
    {
        $user = $this->userService->getAll();
        $product = $this->productService->getProductList();
        $productCount = $this->productService->getCount();

        return view('dashboard.manajer', compact('product', 'user', 'productCount'));
    }

    public function staff()
    {
        $user = $this->userService->getAll();
        $product = $this->productService->getProductList();
        $productCount = $this->productService->getCount();
        $reqIn = $this->stokService->requestIn();
        $reqOut = $this->stokService->requestOut();
        $users = Auth::user();
        $userName = $users->name;

        return view('dashboard.staff', compact('product', 'user', 'productCount', 'reqIn', 'reqOut','userName'));
    }

    protected function showSettings()
    {
        return Setting::where('key', 'logo')->value('value') ?? 'default-logo.png'; // Default logo
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan format gambar yang diizinkan
        ]);
    
        // Proses upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('logos', 'public'); // Simpan gambar di folder 'logos'
    
            // Update logo dalam database (misal, pada model Setting)
            Setting::updateOrCreate(
                ['key' => 'logo'],
                ['value' => $path]
            );
    
            return back()->with('success', 'Logo updated successfully.');
        }
    
        return back()->with('error', 'No image uploaded.');
    }
    

    public function settings(){
        $settingsLogo = Setting::getLogo();
        return view('dashboard.settings', compact('settingsLogo'));
    }
}
