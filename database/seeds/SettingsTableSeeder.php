<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create entry Categories
        Setting::create([
            'title' => 'Warragul National Photographic Comperition',
            'first_section_cost' => 14,
            'additional_section_cost' => 10,
            'terms_and_conditions_url' => 'http://www.warragulnational.org/term_and_conditions.html',
            'max_entries_per_section' => 4,
        ]);

    }
}
