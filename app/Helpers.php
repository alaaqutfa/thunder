<?php

use App\Models\BusinessSetting;
use App\Models\Project;
use App\Models\Service;

if(!function_exists('get_services')) {
    function get_services()
    {
        return Service::active()->ordered()->get();
    }
}

if(!function_exists('setting_value')) {
    function setting_value($key)
    {
        return BusinessSetting::getValue($key);
    }
}
