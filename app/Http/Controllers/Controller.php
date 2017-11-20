<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $settings = false;

    /**
     * Get photocomp settings.
     *
     */
    public function setting($key = false)
    {

        if (!$this->settings) {
            // We need to load the setting object so we can access the settings
            $this->settings = Setting::firstOrFail();

        }
        if ($key && isset($this->settings->$key)) {
            return $this->settings->$key;
        }
        return $this->settings;
    }
}
