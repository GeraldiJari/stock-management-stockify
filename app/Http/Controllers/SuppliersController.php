<?php

namespace App\Http\Controllers;

use App\Services\Suppliers\SuppliersService;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{

    private $suppliersService;

    public function __construct(SuppliersService $suppliersService)
    {
        $this->suppliersService = $suppliersService;
    }
    
    public function index(){
        $suppliers = $this->suppliersService->getAllSuppliers();
        return view('suppliers.list', ['suppliers' => $suppliers]);
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
        ], [
            'name.unique' => 'Nama sudah digunakan, mohon gunakan yang lain.',
            'email.unique' => 'Email sudah ada, mohon gunakan yang lain.',
        ]);

        try{
            $suppliers = $this->suppliersService->getAllSuppliers();
            $this->suppliersService->create( $request->all() );
            return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
        }

        catch (\Exception $e) {
            // Redirect kembali dengan pesan error jika terjadi kesalahan
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan mahasiswa. Pastikan User ID Mahasiswa Sesuai'])->withInput();
        }
    }

    public function edit($id){
        $supplier = $this->suppliersService->find($id); // Ambil pengguna berdasarkan ID
        return view('suppliers.edit', compact('supplier'));
    }

    public function update( Request $request, $id ) {
        $data = $request->only(['name', 'email', 'phone', 'address']);
        $this->suppliersService->updateSuppliers( $id, $data );
        return redirect()->route( 'suppliers.index' );
    }
}
