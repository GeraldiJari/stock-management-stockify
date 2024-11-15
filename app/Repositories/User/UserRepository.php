<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository{


    /**
     * @param mixed $id
     * 
     * @return mixed
     */
    public function getUserID($id);

    public function getAll();

    public function getByEmail($email);

    public function all();
    public function find($id);
    public function create($data);
    public function editUser($id);
    public function updateUser($id, $data);
    public function delete($id);
}
