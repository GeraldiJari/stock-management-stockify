<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Suppliers;
use App\Services\Categories\CategoriesService;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    private $categoriesService;

    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    public function index(){
        $categories = Categories::all();
        $suppliers = Suppliers::all();
        $product = $this->categoriesService->getAllCategories();
        return view('products.categories.list', compact('product', 'categories', 'suppliers'));
    }

    public function create() {
        return view('products.categories.create');
    }

    public function store( Request $request ) {
        $categories = Categories::all();
        $product = $this->categoriesService->getAllCategories();
        $suppliers = Suppliers::all();
        $this->categoriesService->create( $request->all() );
        return view('products.index', compact('product','categories', 'suppliers'));
    }

    public function edit($id){
        $categories = $this->categoriesService->find($id); // Ambil pengguna berdasarkan ID
        // $categories = Categories::all();
        // $suppliers = Suppliers::all();
        return view('products.categories.edit', compact('categories'));
    }

    public function update( Request $request, $id ) {
        $data = $request->only(['name', 'description']);
        $this->categoriesService->editCategories( $id, $data );
        return redirect()->route( 'categories.list' );
    }
}
