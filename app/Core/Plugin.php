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
        $this->registerRoutes();
    }

    private function loadAcfJson(): void
    {
        add_filter(
            'acf/settings/load_json',
            function ($paths) {

                $paths[] = BOOKING_SYSTEM_PATH . 'acf-json';

                return $paths;
            }
        );
    }

    private function registerRoutes(): void
    {
        // Próxima fase
    }
}