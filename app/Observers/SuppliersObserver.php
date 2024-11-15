<?php

namespace App\Observers;

use App\Models\Suppliers;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;

class SuppliersObserver
{
    /**
     * Handle the Suppliers "created" event.
     */
    public function created(Suppliers $suppliers): void
    {
        UserActivity::create([
            'user_id' => Auth::id(),
            'activity' => 'created',
            'target_type' => Suppliers::class,
            'target_id' => $suppliers->id,
            'description' => 'Created product: ' . $suppliers->name,
        ]);
    }

    /**
     * Handle the Suppliers "updated" event.
     */
    public function updated(Suppliers $suppliers): void
    {
        UserActivity::create([
            'user_id' => Auth::id(),
            'activity' => 'updated',
            'target_type' => Suppliers::class,
            'target_id' => $suppliers->id,
            'description' => 'Updated product: ' . $suppliers->name,
        ]);
    }

    /**
     * Handle the Suppliers "deleted" event.
     */
    public function deleted(Suppliers $suppliers): void
    {
        //
    }

    /**
     * Handle the Suppliers "restored" event.
     */
    public function restored(Suppliers $suppliers): void
    {
        //
    }

    /**
     * Handle the Suppliers "force deleted" event.
     */
    public function forceDeleted(Suppliers $suppliers): void
    {
        //
    }
}
