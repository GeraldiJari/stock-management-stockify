<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;
use Illuminate\Http\Request;

class ManajerGudangController extends Controller
{
    //

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(){
        $user = $this->userService->getAll();
        // return response()->json($user);
        return view('tes.daftar',$user);
    }
}
