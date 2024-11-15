<?php

namespace App\Observers;

use App\Models\StockTransactions;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;

class StockTransactionsObserver
{
    /**
     * Handle the StockTransactions "created" event.
     */
    public function created(StockTransactions $stockTransactions): void
    {
        UserActivity::create([
            'user_id' => Auth::id(),
            'activity' => 'created',
            'target_type' => StockTransactions::class,
            'target_id' => $stockTransactions->id,
            'description' => 'Created Stok Transaksi: ' . $stockTransactions->product->name,
        ]);
    }

    /**
     * Handle the StockTransactions "updated" event.
     */
    public function updated(StockTransactions $stockTransactions): void
    {
        UserActivity::create([
            'user_id' => Auth::id(),
            'activity' => 'updated',
            'target_type' => StockTransactions::class,
            'target_id' => $stockTransactions->id,
            'description' => 'Updated Stok Transaksi: ' . $stockTransactions->product->name,
        ]);
    }

    /**
     * Handle the StockTransactions "deleted" event.
     */
    public function deleted(StockTransactions $stockTransactions): void
    {
        //
    }

    public function exported()
    {
        UserActivity::create([
            'user_id' => Auth::id(),
            'activity' => 'exported',
            'target_type' => StockTransactions::class,
            'target_id' => null, // Set null jika tidak ada ID spesifik
            'description' => 'Exported stok list',
        ]);
    }

    /**
     * Handle the StockTransactions "restored" event.
     */
    public function restored(StockTransactions $stockTransactions): void
    {
        //
    }

    /**
     * Handle the StockTransactions "force deleted" event.
     */
    public function forceDeleted(StockTransactions $stockTransactions): void
    {
        //
    }
}
