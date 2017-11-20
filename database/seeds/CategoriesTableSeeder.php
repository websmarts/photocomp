<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create entry Categories
        Category::create([
            'name' => 'Projected Digital Images',
            'display_order' => 1,
        ]);

        Category::create([
            'name' => 'Prints',
            'display_order' => 2,
        ]);

    }
}
