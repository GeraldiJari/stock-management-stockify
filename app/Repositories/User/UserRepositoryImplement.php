<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use LaravelEasyRepository\Implementations\Eloquent;

class UserRepositoryImplement extends Eloquent implements UserRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUserID($id){
        return $this->model->findOrFail($id);
    }

    public function getAll(){
        $user['user'] = User::orderBy('id')
        ->paginate(20);

        return $user;
    }

    public function all() {
        return User::all();
    }

    public function find($id) {
        return User::findOrFail($id);
    }

    public function create($data) {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function editUser( $id ) {
        return User::find( $id );
    }

    public function updateUser( $id, $data ) {
        return User::find( $id )->update( $data );
    }

    public function delete($id) {
        return User::destroy($id);
    }
    
    
    /**
     * getByEmail
     *
     * @param mixed $email
     * @return void
     */

    public function getByEmail($email)
    {
        $user['user'] = User::orderBy('id')
        ->where("email", $email)->paginate(1);
        return $user;
    }
}
