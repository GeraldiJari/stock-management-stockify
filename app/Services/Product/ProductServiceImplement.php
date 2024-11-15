<?php

namespace App\Services\Product;

use LaravelEasyRepository\Service;
use App\Repositories\Product\ProductRepository;

class ProductServiceImplement extends Service implements ProductService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ProductRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAllProducts() {
      return $this->mainRepository->all();
    }

    public function getAllCategories() {
      return $this->mainRepository->all();
    }

    public function createCategories($data)
    {
      return $this->mainRepository->create($data);
    }

    public function getProductList()
    {
      return $this->mainRepository->getProductList();
    }

    public function createProductAttribute($data)
    {
      return $this->mainRepository->createProductAttribute($data);
    }

    public function getAttribute()
    {
      return $this->mainRepository->getAttribute();
    }

    public function updateProduct($id, $data)
    {
      return $this->mainRepository->updateProduct($id, $data);
    }

    public function updateAttribute($id, $data)
    {
      return $this->mainRepository->updateAttribute($id, $data);
    }

    public function findAttribute($id)
    {
      return $this->mainRepository->findAttribute($id);
    }

    public function getCount()
    {
        return $this->mainRepository->getCount();
    }

    // Define your custom methods :)
}
