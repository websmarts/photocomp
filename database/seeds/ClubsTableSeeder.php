<?php

use App\Club;
use Illuminate\Database\Seeder;

class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Load club data from spreadsheet if it exists
        $file = './database/seeds/vaps_clubs.txt';
        if (!file_exists($file)) {
            echo 'Clubs import file: ' . $file . ' could not be found, NO CLUBS WERE IMPORTED!!' . "\r\n";
            return;
        }

        $clubs = file($file);
        sort($clubs);
        foreach ($clubs as $club) {
            Club::create(['name' => trim($club)]);
        }

    }
}
