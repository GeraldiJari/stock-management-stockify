<?php

namespace App\Repositories\Product;

use LaravelEasyRepository\Repository;

interface ProductRepository extends Repository{

    // Write something awesome :)

    public function allProduct();

    public function allCategories();
    public function createCategories($data);
    public function getProductList();
    public function createProductAttribute($data);
    public function getAttribute();
    public function updateProduct($id, $data);
    public function updateAttribute($id, $data);
    public function findAttribute($id);

    public function getCount(): int;
}
