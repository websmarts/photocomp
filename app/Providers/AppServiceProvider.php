<?php

namespace App\Providers;

use App\Setting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
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
        // Fix for mysql key length error
        Schema::defaultStringLength(191);

        Gate::define('admin', function ($user) {
            return $user->is_admin == 'yes';
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
