<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\StockTransactions;
use App\Models\Suppliers;
use App\Observers\ProductObserver;
use App\Observers\StockTransactionsObserver;
use App\Observers\SuppliersObserver;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceImplement;
use App\Services\StockTransactions\StockTransactionsService;
use App\Services\StockTransactions\StockTransactionsServiceImplement;
use App\Services\Suppliers\SuppliersService;
use App\Services\Suppliers\SuppliersServiceImplement;
use App\Services\User\UserService;
use App\Services\User\UserServiceImplement;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserService::class, UserServiceImplement::class);
        $this->app->bind(ProductService::class, ProductServiceImplement::class);
        $this->app->bind(SuppliersService::class, SuppliersServiceImplement::class);
        $this->app->bind(StockTransactionsService::class, StockTransactionsServiceImplement::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Product::observe(ProductObserver::class);
        Suppliers::observe(SuppliersObserver::class);
        StockTransactions::observe(StockTransactionsObserver::class);
    }
}
