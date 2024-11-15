<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManajerGudangController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockTransactionsController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use App\Models\Suppliers;
use App\Models\User;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;



Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('settings', [DashboardController::class, 'settings'])->name('setting.conf');
Route::put('settings/upload/{value}',[DashboardController::class, 'upload'])->name('settings.upload');
Route::put('/settings/image', [DashboardController::class, 'updateLogo'])->name('settings.updateLogo');

// Route::get('/dashboard', function () {
//     return view('example.index', ['title' => 'Dashboard']);
// })->name('index');

Route::group(['middleware'=>'admin'], function(){
    //Users
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('user.index');
    Route::get('/list', [UserController::class, 'index'])->name('user.tes');
    Route::post( '/store', [UserController::class, 'store'] )->name( 'user.store' );
    Route::get('/tes/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/tes/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'delete'])->name('user.delete');

    //Products
    Route::get('/products/index', [ProductController::class, 'index'])->name('product.index');
    Route::post('/products/store', [ProductController::class, 'store'])->name('productAll.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/edit/{id}', [ProductController::class, 'update'])->name('product.update');
    
    //Categories Product
    Route::get('/products/categories/create', [CategoriesController::class, 'create'])->name('product.create');
    Route::post('/products/categories/store', [CategoriesController::class, 'store'])->name('product.store');
    Route::get('/products/categories/list', [CategoriesController::class, 'index'])->name('categories.list');
    Route::get('/products/categories/edit/{id}', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/products/categories/edit/{id}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::get('/products/export-pdf', [ProductController::class, 'export'])->name('product.export');
    Route::post('/products/import',[ProductController::class, 'import'])->name('product.import');

    //Suppliers
    Route::get('/suppliers/list', [SuppliersController::class, 'index'])->name('suppliers.index');
    Route::post('/suppliers/store', [SuppliersController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/edit/{id}', [SuppliersController::class, 'edit'])->name('suppliers.edit');
    Route::put('/suppliers/edit/{id}', [SuppliersController::class, 'update'])->name('suppliers.update');

    //Attributes Products
    Route::get('/products/attribute/list',[ProductController::class, 'attribute'])->name('attribute.list');
    Route::post('/products/attribute/store',[ProductController::class, 'storeAttribute'])->name('attribute.store');
    Route::get('/products/attribute/edit/{id}',[ProductController::class, 'editAttribute'])->name('attribute.edit');
    Route::put('/products/attribute/edit/{id}',[ProductController::class, 'updateAttribute'])->name('attribute.update');

    //Stok
    Route::get('/stoks/list',[StockTransactionsController::class, 'list'])->name('stok.list');
    Route::post('/stoks/store',[StockTransactionsController::class, 'store'])->name(('stok.store'));
    Route::get('/stoks/edit/{id}', [StockTransactionsController::class, 'edit'])->name('stok.edit');
    Route::put('/stoks/edit/{id}', [StockTransactionsController::class, 'update'])->name('stok.update');
    Route::put('/settings/min-quantity', [StockTransactionsController::class, 'updateQuantities'])->name('settings.updateMinQuantity');
    Route::get('/stoks/list-masuk',[StockTransactionsController::class, 'stokIn'])->name('stok.typeIn');
    Route::get('/stoks/list-keluar',[StockTransactionsController::class, 'stokOut'])->name('stok.typeOut');

    Route::get('/user/activities', [UserController::class, 'showUserActivities'])->name('user.activities');
    // Route::get('/stoks/list', [])

    Route::get('/stoks/export-type/{type}', [StockTransactionsController::class, 'exportType']);
    Route::get('/products/exportPDF', [ProductController::class, 'exportPDF'])->name('products.export.pdf');
});

Route::group(['middleware'=>'manajer_gudang'], function(){
    Route::get('manajer/', [DashboardController::class, 'manajer'])->name('mj.tes');
});

Route::group(['middleware'=>'staff_gudang'], function(){
    Route::get('staff/', [DashboardController::class, 'staff'])->name('staff.tes');
    Route::get('/dashboard/activities/request/{id}', [StockTransactionsController::class, 'editOp'])->name('stok.edit');
    Route::put('/dashboard/activities/request/{id}', [StockTransactionsController::class, 'opname'])->name('stok.opname');
    Route::get('/staff/productList', [StockTransactionsController::class, 'opnameStok'])->name('staff.stok');
});

Route::group(['middleware'=>'admin_or_manajer'], function(){
    
    Route::get('/products/index', [ProductController::class, 'index'])->name('product.index');
    Route::post('/products/store', [ProductController::class, 'store'])->name('productAll.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/edit/{id}', [ProductController::class, 'update'])->name('product.update');

    Route::get('/stoks/list',[StockTransactionsController::class, 'list'])->name('stok.list');
    Route::post('/stoks/store',[StockTransactionsController::class, 'store'])->name(('stok.store'));

    //Suppliers
    Route::get('/suppliers/list', [SuppliersController::class, 'index'])->name('suppliers.index');
    Route::post('/suppliers/store', [SuppliersController::class, 'store'])->name('suppliers.store');
    Route::get('/stoks/export-pdf', [StockTransactionsController::class, 'exportPDF'])->name('stok.export');
    // Route::get('/role-job/manager/index', [UserController::class, 'indexMJ'])->name('mj.index');
});

Route::get('authentication/sign-in', function () {
    return view('example.content.authentication.sign-in', ['title' => 'Sign In']);
})->name('sign-in');

Route::get('authentication/sign-up', function () {
    return view('example.content.authentication.sign-up', ['title' => 'Sign In']);
})->name('sign-up');
