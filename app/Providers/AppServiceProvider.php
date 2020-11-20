<?php

namespace App\Providers;

use App\Mail\QueueFailure;
use App\Setting;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Fix for mysql key length error - only on string unique index fields
        //Schema::defaultStringLength(191);

        Gate::define('admin', function ($user) {
            return $user->is_admin == 'yes';
        });

        Gate::define('enter', function ($user) {
            return $user->is_admin !== 'yes';
        });

        /**
         * Make settings data available to all views
         *
         * need to use try catch as this fails during migrations
         * when table does not exist
         */
        try {
            $settings = Setting::firstOrFail();
            View::share('settings', $settings);
        } catch (\Exception $e) {}

        /**
         * Use to report whenever the queue fails
         */
        Queue::failing(function (JobFailed $event) {
            Mail::to('iwmaclagan@gmail.com')->send(new QueueFailure());
        });

        

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
