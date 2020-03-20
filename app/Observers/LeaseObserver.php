<?php

namespace App\Observers;

use App\Lease;
use App\Book;

class LeaseObserver
{
    /**
     * Handle the lease "created" event.
     *
     * @param  \App\Lease  $lease
     * @return void
     */
    public function created(Lease $lease)
    {
        Book::find($lease->book_id)->decrement('quantity');
        $lease->end_date = now()->addDays($lease->duration);
        $lease->save();
    }

    /**
     * Handle the lease "updated" event.
     *
     * @param  \App\Lease  $lease
     * @return void
     */
    public function updated(Lease $lease)
    {
        //
    }

    /**
     * Handle the lease "deleted" event.
     *
     * @param  \App\Lease  $lease
     * @return void
     */
    public function deleted(Lease $lease)
    {
        Book::find($lease->book_id)->increment('quantity');
    }

    /**
     * Handle the lease "restored" event.
     *
     * @param  \App\Lease  $lease
     * @return void
     */
    public function restored(Lease $lease)
    {
        //
    }

    /**
     * Handle the lease "force deleted" event.
     *
     * @param  \App\Lease  $lease
     * @return void
     */
    public function forceDeleted(Lease $lease)
    {
        //
    }
}
