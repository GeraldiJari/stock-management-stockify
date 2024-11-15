<?php

namespace App\Services\Categories;

use LaravelEasyRepository\Service;
use App\Repositories\Categories\CategoriesRepository;

class CategoriesServiceImplement extends Service implements CategoriesService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(CategoriesRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAllCategories() {
      return $this->mainRepository->all();
    }

    public function createCategories($data)
    {
      return $this->mainRepository->create($data);
    }

    public function editCategories($id, $data)
    {
      return $this->mainRepository->editCategories($id, $data);
    }

    // Define your custom methods :)
}
