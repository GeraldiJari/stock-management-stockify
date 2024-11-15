<?php

namespace App\Http\Controllers;

use App\Models\StockTransactions;
use App\Models\User;
use App\Models\UserActivity;
use App\Repositories\User\UserRepository;
use App\Services\Product\ProductService;
use App\Services\User\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $userRepository;
    private $userService;
    private $productService;


    public function __construct(UserService $userService, ProductService $productService)
    {
        $this->userService = $userService;
        $this->productService = $productService;
    }
    
    public function showUserActivities()
    {
        $activities = UserActivity::with('user')->latest()->get();
        return view('dashboard.activities.activity', compact('activities'));
    }

    public function index(){
        $user = $this->userService->getAll();
        // return response()->json($user);
        return view('tes.daftar',$user);
    }

    public function findByEmail($email){
        $user = $this->userService->getByEmail($email);
        return view('tes.daftar',$user);
    }

    public function create() {
        return view('tes.create');
    }
    public function store( Request $request ) {

        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,manajer_gudang,staff_gudang',
        ], [
            'name.unique' => 'Nama sudah digunakan, mohon gunakan yang lain.',
            'email.unique' => 'Email sudah ada, mohon gunakan yang lain.',
        ]);

        try{
            $user = $this->userService->getAll();
            $this->userService->create( $request->all() );
            return view('tes.daftar',$user);
        }

        catch (\Exception $e) {
            // Redirect kembali dengan pesan error jika terjadi kesalahan
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan mahasiswa. Pastikan User ID Mahasiswa Sesuai'])->withInput();
        }
    }

    public function edit($id)
    {
        $user = $this->userService->find($id); // Ambil pengguna berdasarkan ID
        return view('layout.modals.edit', compact('user'));
    }

    public function update( Request $request, $id ) {
        $data = $request->only(['name', 'email', 'role']);
        $this->userService->updateUser( $id, $data );
        return redirect()->route( 'user.tes' );
    }

    public function delete($id){
        $this->userService->delete($id);
        return redirect()->route('user.tes')->with('success', 'User deleted successfully');
    }

    public function editt($id)
    {
        $user = $this->userService->find($id); // Fetch user by ID
        return response()->json([
            'success' => true,
            'message' => 'User details fetched successfully',
            'data'    => $user
        ]);
    }

    public function updatee(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,manajer_gudang,staff_gudang',
        ], [
            'name.unique' => 'Nama sudah digunakan, mohon gunakan yang lain.',
            'email.unique' => 'Email sudah ada, mohon gunakan yang lain.',
        ]);

        $data = $request->only(['name', 'email', 'role']);
        $this->userService->updateUser($id, $data);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
        ]);
    }

}
