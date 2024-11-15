<?php

namespace App\Services\Suppliers;

use LaravelEasyRepository\Service;
use App\Repositories\Suppliers\SuppliersRepository;

class SuppliersServiceImplement extends Service implements SuppliersService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(SuppliersRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAllSuppliers() {
      return $this->mainRepository->getAll();
    } 

    public function createSuppliers($data) {
      return $this->mainRepository->create($data);
    }

    public function updateSuppliers($id, $data)
    {
      return $this->mainRepository->suppliersUpdate($id, $data);
    }



    // Define your custom methods :)
}
