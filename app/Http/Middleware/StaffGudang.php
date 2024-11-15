<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffGudang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role != 'staff_gudang'){
            // Auth::user()->role = 'admin';
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses tersebut');
        }
        // if (Auth::user()->usertype != 'user'){
        //     return redirect('admin/dashboard');
        // }
        return $next($request);
    }
}
