<?php

namespace App\Observers;

use App\Models\compra;
use Illuminate\Support\Facades\Auth;


class CompraObserver
{
    /**
     * Handle the compra "created" event.
     */
    public function created(compra $compra): void
    {
        //
    }

    public function creating(compra $compra): void
    {
        $compra->user_id = Auth::id();
    }

    /**
     * Handle the compra "updated" event.
     */
    public function updated(compra $compra): void
    {
        //
    }

    /**
     * Handle the compra "deleted" event.
     */
    public function deleted(compra $compra): void
    {
        //
    }

    /**
     * Handle the compra "restored" event.
     */
    public function restored(compra $compra): void
    {
        //
    }

    /**
     * Handle the compra "force deleted" event.
     */
    public function forceDeleted(compra $compra): void
    {
        //
    }
}
