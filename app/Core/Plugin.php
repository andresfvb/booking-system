<?php

namespace BookingSystem\Core;

defined('ABSPATH') || exit;

class Plugin
{
    public static function init(){
        $instance = new self();

        $instance->registerHooks();
    }

    private function registerHooks(){
        add_action(
            'plugins_loaded',
            [$this, 'boot']
        );
    }

    public function boot(){
        $this->loadAcfJson();
        \BookingSystem\Providers\AcfProvider::boot();
        $this->registerRoutes();
    }

    private function loadAcfJson()
    {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        add_filter(
            'acf/settings/load_json',
            function ($paths) {

                $paths[] = BOOKING_SYSTEM_PATH . 'acf-json';

                return $paths;
            }
        );

        add_filter(
            'acf/settings/save_json',
            function () {

                return BOOKING_SYSTEM_PATH . 'acf-json';
            }
        );
    }

    private function registerRoutes()
    {
        add_action(
            'rest_api_init',
            [
                \BookingSystem\Routes\ApiRoutes::class,
                'register'
            ]
        );
    }
}