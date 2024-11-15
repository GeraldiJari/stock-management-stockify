<?php

namespace App\Repositories\Suppliers;

use LaravelEasyRepository\Repository;

interface SuppliersRepository extends Repository{

    public function getAll();

    public function createSuppliers($data);
    
    public function suppliersUpdate($id, $data);
}
