<?php

namespace App\Observers;

use App\Review;
use App\Book;

class ReviewObserver
{
    /**
     * Handle the review "created" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function created(Review $review)
    {
        $avgRate = sprintf("%.1f", Review::where('book_id', $review->book_id)->pluck('rate')->average());   ## to round the number to 1 decimal number
        $book = Book::find($review->book_id);
        $book->rate = floor($avgRate * 2) / 2;     ## rounding the average before saving it to accept only 1 or 1.5
        $book->save();
    }

    /**
     * Handle the review "updated" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function updated(Review $review)
    {
        $this->created($review);
    }

    /**
     * Handle the review "deleted" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function deleted(Review $review)
    {
        $this->created($review);
    }

    /**
     * Handle the review "restored" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function restored(Review $review)
    {
        $this->created($review);
    }

    /**
     * Handle the review "force deleted" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function forceDeleted(Review $review)
    {
        $this->created($review);
    }
}
