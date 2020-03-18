<?php

use Illuminate\Database\Seeder;

class FavouritesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Favourite::class, 100)->create();
    }
}
