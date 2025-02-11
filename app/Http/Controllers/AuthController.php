<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        // dd(Hash::make(123456));
        if(!empty(Auth::check())){
            if(Auth::user()->user_type == 1){
                return redirect('admin/dashboard');
            }
            elseif(Auth::user()->user_type == 2){
                return redirect('dosen/dashboard');
            }
            elseif(Auth::user()->user_type == 3){
                return redirect('mahasiswa/dashboard');
            }
        }
        return view('auth.login');
    }

    public function AuthLogin(Request $request){
        $remember = !empty($request->remember) ? true : false;

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)){
            if(Auth::user()->role == 'admin'){
                return redirect()->route( 'user.index' );
            }
            elseif(Auth::user()->role == 'manajer_gudang'){
                return redirect()->route( 'mj.tes' );
            }
            elseif(Auth::user()->role == 'staff_gudang'){
                return redirect()->route('staff.tes');
            }
        }else{
            return redirect()->back()->with('error', 'Please enter current email and password');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }
}
