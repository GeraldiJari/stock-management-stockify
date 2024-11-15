<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\Categories;
use App\Models\Product;
use App\Models\Suppliers;
use App\Observers\ProductObserver;
use App\Services\Product\ProductService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    //CRUD Product

    public function index(){
        $product = $this->productService->getProductList();
        $categories = Categories::all();
        $suppliers = Suppliers::all();
        return view('products.index', compact('product', 'categories', 'suppliers'));
    }

    public function create() {
        return view('products.categories.create', compact('product', 'categories'));
    }

    public function store( Request $request ) {
        $product = $this->productService->getAllCategories();
        $categories = Categories::all();
        $suppliers = Suppliers::all();

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
    
        $this->productService->create($data);
    
        return redirect()->route('product.index')->with('success', 'Product added successfully.');
    }

    public function edit($id){
        $product = $this->productService->find($id); // Ambil pengguna berdasarkan ID
        $categories = Categories::all();
        $suppliers = Suppliers::all();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update( Request $request, $id ) {
        $data = $request->only(['name']);
        $this->productService->updateProduct( $id, $data );
        return redirect()->route( 'product.index' );
    }

    //CRUD Attribute Product

    public function attribute(){
        $products = $this->productService->getProductList();
        $attribute = $this->productService->getAttribute();
        return view('products.attribute.list', compact('attribute', 'products'));
    }

    public function storeAttribute(Request $request){
        
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        $this->productService->createProductAttribute($request->all());

        return redirect()->back()->with('success', 'Product attribute created successfully.');

    }

    public function editAttribute($id){
        $attribute = $this->productService->findAttribute($id); // Ambil pengguna berdasarkan ID
        $product = Product::all();
        // $categories = Categories::all();
        // $suppliers = Suppliers::all();
        return view('products.attribute.edit', compact('attribute', 'product'));
    }

    public function updateAttribute( Request $request, $id ) {
        $data = $request->only(['name', 'product_id', 'value']);
        $this->productService->updateAttribute( $id, $data );
        return redirect()->route( 'attribute.list' );
    }

    public function export()
    {
        $products = Product::with('category')->get();

        // Path ke gambar logo
        $imagePath = public_path('images/logo.png'); // Ganti dengan path gambar Anda

        // Data yang akan dikirim ke view
        $data = [
            'products' => $products,
            'image' => $imagePath, // Menyertakan path gambar
        ];

        $pdf = Pdf::loadView('products.report', $data); // Menggunakan view untuk PDF
        return $pdf->stream(); // Mengunduh file PDF
    }

    public function exportPDF()
    {
        $products = Product::with('category')->get();

        // Path ke gambar logo
        $imagePath = public_path('images/logo.png'); // Ganti dengan path gambar Anda

        // Data yang akan dikirim ke view
        $data = [
            'products' => $products,
            'image' => $imagePath, // Menyertakan path gambar
        ];

        $pdf = PDF::loadView('products.report', $data);

        // Panggil metode exported() dari ProductObserver untuk mencatat aktivitas
        $observer = new ProductObserver();
        $observer->exported();

        return $pdf->stream();
    }

    public function import(Request $request)
    {
        // Validasi file input
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Impor data produk dari file
        Excel::import(new ProductImport, $request->file('file'));

        return back()->with('success', 'Products imported successfully!');
    }
}
