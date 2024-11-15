<?php

namespace App\Services\Product;

use LaravelEasyRepository\BaseService;

interface ProductService extends BaseService{

    // Write something awesome :)

    public function getAllCategories();

    public function createCategories($data);

    public function getProductList();

    public function createProductAttribute($data);

    public function getAttribute();

    public function updateProduct($id, $data);

    public function updateAttribute($id, $data);

    public function findAttribute($id);

    public function getCount();
}
