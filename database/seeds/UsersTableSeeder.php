<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the admin users
        User::create([
            'email' => 'ian@here.com',
            'password' => 'pass',
            'is_admin' => 'yes',
            'verified' => 1,
        ]);

        // Create the admin users
        User::create([
            'email' => 'ian@there.com',
            'password' => 'pass',
            'is_admin' => 'no',

        ]);
    }
}
