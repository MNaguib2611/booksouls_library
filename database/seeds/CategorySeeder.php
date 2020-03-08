<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(["name" => "History"]);
        Category::create(["name" => "Arts"]);
        Category::create(["name" => "Music"]);
        Category::create(["name" => "Kids"]);
        Category::create(["name" => "Business"]);
        Category::create(["name" => "Computers"]);
    }
}
