<?php

use App\Section;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create entry Categories
        //
        $categoryIds = [1, 2];
        $sections[1] = ['Still Life', 'Photo Journalism', 'Open', 'Seascape', 'Nature'];
        $sections[2] = [
            'Open Prints Monochrome',
            'Open Prints Colour',
            'Animal Prints Mono or Colour',
            'Architecture Prints Mono or Colour',
            'Creative Prints Mono or Colour',
            'Landscape Prints',
            'Portrait/People Prints Mono or Colour',

        ];
        foreach ($categoryIds as $categoryId) {
            $displayOrder = 1;
            foreach ($sections[$categoryId] as $section) {
                Section::create([
                    'name' => $section,
                    'category_id' => $categoryId,
                    'display_order' => $displayOrder++,
                ]);
            }
        }

    }
}
