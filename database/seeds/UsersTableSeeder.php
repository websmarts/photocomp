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
            'email' => env('APP_ADMIN_USERNAME', 'admin'),
            'password' => env('APP_ADMIN_PASSWORD', 'pass'),
            'is_admin' => 'yes',
            'verified' => 1,
        ]);

        // Create the admin users
        User::create([
            'email' => 'iwmaclagan@gmail.com',
            'password' => 'pass',
            'is_admin' => 'no',
            'verified' => 1,

        ]);
    }
}
