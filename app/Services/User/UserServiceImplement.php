<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use Exception;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Log;
use LaravelEasyRepository\Service;

class UserServiceImplement extends Service implements UserService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }
    
    public function getAllUsers() {
        return $this->mainRepository->all();
    }

    public function getUserById($id) {
        return $this->mainRepository->find($id);
    }

    public function createUser($data) {
        return $this->mainRepository->create($data);
    }

    public function editUser( $id ) {
      return User::find( $id );
    }

    public function updateUser($id, $data) {
        return $this->mainRepository->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->mainRepository->delete($id);
    }

    public function getByEmail($email)
    {
      try {
        return $this->mainRepository->getByEmail($email);
      } catch (Exception $exception) {
        Log::debug($exception->getMessage());
        return [];
      }
    }

    public function getAll()
    {
      try {
        return $this->mainRepository->getAll();
      } catch (Exception $exception) {
        Log::debug($exception->getMessage());
        return [];
      }
    }

    // Define your custom methods :)
}
