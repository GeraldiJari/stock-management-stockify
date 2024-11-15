<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    public function created(Product $product)
    {
        UserActivity::create([
            'user_id' => Auth::id(),
            'activity' => 'created',
            'target_type' => Product::class,
            'target_id' => $product->id,
            'description' => 'Created product: ' . $product->name,
        ]);
    }

    public function updated(Product $product)
    {
        UserActivity::create([
            'user_id' => Auth::id(),
            'activity' => 'updated',
            'target_type' => Product::class,
            'target_id' => $product->id,
            'description' => 'Updated product: ' . $product->name,
        ]);
    }

    public function deleted(Product $product)
    {
        UserActivity::create([
            'user_id' => Auth::id(),
            'activity' => 'deleted',
            'target_type' => Product::class,
            'target_id' => $product->id,
            'description' => 'Deleted product: ' . $product->name,
        ]);
    }

    public function exported()
    {
        UserActivity::create([
            'user_id' => Auth::id(),
            'activity' => 'exported',
            'target_type' => Product::class,
            'target_id' => null, // Set null jika tidak ada ID spesifik
            'description' => 'Exported product list',
        ]);
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
