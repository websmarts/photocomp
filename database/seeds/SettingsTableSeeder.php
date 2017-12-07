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
            'title' => 'Warragul National Photographic Competition',
            'first_section_cost' => 14,
            'additional_section_cost' => 10,
            'digital_only_entry_surcharge' => 2,
            'terms_and_conditions_url' => 'http://www.warragulnational.org/term_and_conditions.html',
            'max_entries_per_section' => 4,
            'return_instructions' => "No Return Required (default)\nReturn by Post (typically $20)\nPickup Roylaines - Warragul\nPickup Roylaines - Pakenham\nForward to Pakenham National",
            'competition_status' => "Closed",
            'paypal_mode' => 'Sandbox',
        ]);

    }
}
