<?php

namespace App\Services\User;

use LaravelEasyRepository\BaseService;

interface UserService extends BaseService{
    
    /**
     * getByEmail
     *
     * @param $email
     * @return mixed
     */
    public function getByEmail($email);
    
    public function getAll();

    public function editUser($id);

    public function updateUser($id, $data);

    
}
