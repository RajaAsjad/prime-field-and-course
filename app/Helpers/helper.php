<?php 
use App\Models\PageSetting;
use App\Models\Testimonial;

/**
 * Get site config value(s) from config/site.php
 */
function site($key = null, $default = null)
{
    if ($key === null) {
        return config('site');
    }

    return data_get(config('site'), $key, $default);
}

function globalData()
{
    $page_settings = PageSetting::get(['parent_slug', 'key', 'value']);
    $home_page_data = [];
    foreach ($page_settings as $key => $page_setting) {
        $home_page_data[$page_setting->key] = $page_setting->value;
    }
    return $home_page_data;
}

function testimonials()
{
    return $testimonials = Testimonial::where('status' ,'=', 1)->get();
}