<?php

namespace App\Services\Categories;

use LaravelEasyRepository\BaseService;

interface CategoriesService extends BaseService{

    // Write something awesome :)

    public function getAllCategories();

    public function createCategories($data);

    public function editCategories($id, $data);
}
