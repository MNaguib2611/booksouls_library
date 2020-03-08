<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BooksSeeder::class);
        $this->call(FavouritesSeeder::class);
        $this->call(LeaseSeeder::class);
        $this->call(ProfitSeeder::class);
        $this->call(ReviewsSeeder::class);
    }
}
