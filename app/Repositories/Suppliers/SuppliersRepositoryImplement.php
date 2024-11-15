<?php

namespace App\Repositories\Suppliers;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Suppliers;

class SuppliersRepositoryImplement extends Eloquent implements SuppliersRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Suppliers $model)
    {
        $this->model = $model;
    }

    public function getAll(){
        return Suppliers::all();
    }

    public function createSuppliers($data) {
        return Suppliers::create($data);
    }

    public function suppliersUpdate($id, $data)
    {
        return $this->model->find($id)->update($data);
    }

    // Write something awesome :)
}
