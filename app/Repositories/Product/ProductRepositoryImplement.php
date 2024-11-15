<?php

namespace App\Repositories\Product;

use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductAttribute;
use LaravelEasyRepository\Implementations\Eloquent;

class ProductRepositoryImplement extends Eloquent implements ProductRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function allProduct() {
        return Product::all();
    }

    public function allCategories()
    {
        return Categories::all();
    }

    public function updateProduct( $id, $data ) {
        return Product::find( $id )->update( $data );
    }

    public function createCategories($data){
        return Categories::create($data);
    }

    public function getProductList() {
        return Product::select('products.*', 'categories.name as category_name', 'suppliers.name as supplier_name')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('suppliers', 'suppliers.id', '=', 'products.supplier_id')
            ->orderBy('products.id', 'asc')
            ->get();
    }

    public function createProductAttribute($data)
    {
        return ProductAttribute::create($data);
    }

    public function getAttribute()
    {
        return ProductAttribute::select('product_attributes.*', 'products.name as product_name')
        ->join('products', 'products.id', '=', 'product_attributes.product_id')
        ->get();
        // return ProductAttribute::all();
    }

    // public function updateAttribute($id, $data)
    // {
    //     return ProductAttribute::find( $id )->update( $data );
    // }

    public function updateAttribute($id, $data) {
        // Cari ProductAttribute berdasarkan ID
        $attribute = ProductAttribute::find($id);
        
        // Jika atribut ditemukan, update dengan data yang diberikan
        if ($attribute) {
            $attribute->update($data);
    
            // Ambil kembali data atribut yang telah di-update dengan join untuk mendapatkan informasi produk
            return ProductAttribute::select('product_attributes.*', 'products.name as product_name', 'products.description as product_description')
                ->join('products', 'products.id', '=', 'product_attributes.product_id')
                ->where('product_attributes.id', $id)
                ->first(); // Menggunakan first() karena kita hanya butuh satu record
        }
    
        // Jika atribut tidak ditemukan, kembalikan null atau tangani sesuai kebutuhan
        return null;
    }
    

    public function findAttribute($id) {
        return ProductAttribute::with('product')->find($id);
    }

    public function getCount(): int
    {
        return Product::count();
    }

    // Write something awesome :)
}
