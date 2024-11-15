<?php

namespace App\Repositories\Categories;

use LaravelEasyRepository\Repository;

interface CategoriesRepository extends Repository{

    // Write something awesome :)
    public function allCategories();
    public function createCategories($data);
    public function editCategories($id, $data);
}
