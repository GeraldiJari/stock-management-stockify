<?php

namespace App\Services\Suppliers;

use LaravelEasyRepository\BaseService;

interface SuppliersService extends BaseService{

    // Write something awesome :)

    public function getAllSuppliers();

    public function updateSuppliers($id, $data);
}
