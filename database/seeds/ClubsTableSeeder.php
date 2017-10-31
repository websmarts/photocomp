<?php

use App\Club;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

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
        $file = './database/seeds/vaps_clubs.xlsx';
        if (!file_exists($file)) {
            echo 'Clubs import file: ' . $file . ' could not be found, NO CLUBS WERE IMPORTED!!' . "\r\n";
            return;
        }

        Excel::load($file, function ($reader) {

            // reader methods
            $results = $reader->all()->first(); // first worksheet

            $results->sortBy('club')->each(function ($row, $key) {
                Club::create(['name' => $row->club]);
            });

        });

    }
}
