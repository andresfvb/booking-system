<?php

namespace BookingSystem\Providers;

defined('ABSPATH') || exit;

class AcfProvider
{
    public static function boot()
    {
        if (!function_exists('acf_add_options_page')) {
            return;
        }

        self::registerOptionsPage();
    }

    private static function registerOptionsPage()
    {
        acf_add_options_page([
            'page_title' => 'Booking Settings',
            'menu_title' => 'Booking Settings',
            'menu_slug'  => 'booking-settings',
            'capability' => 'manage_options',
            'redirect'   => false,
        ]);
    }
}