<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class PurgeUnverifiedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes user records where email has not been verified within time limit';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        User::where('verified' ,'=', 0)
            ->where( 'created_at', '<', Carbon::now()->subDays(1))
            ->where('is_admin','=','no')
            ->delete();
    }
}
