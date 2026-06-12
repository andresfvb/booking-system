<?php

/**
 * Plugin Name: Booking System
 * Description: Technical Test
 * Version: 1.0.0
 */


defined('ABSPATH') || exit;

define('BOOKING_SYSTEM_VERSION', '1.0.0');

define(
    'BOOKING_SYSTEM_PATH',
    plugin_dir_path(__FILE__)
);

define(
    'BOOKING_SYSTEM_URL',
    plugin_dir_url(__FILE__)
);
define(
    'BOOKING_SYSTEM_DB_VERSION',
    '1.0.0'
);



require_once __DIR__ . '/vendor/autoload.php';

BookingSystem\Core\Plugin::init();

if (!defined('ABSPATH')) {
    exit;
}

use BookingSystem\Core\Plugin;
use BookingSystem\Database\Migrations;

register_activation_hook(
    __FILE__,
    [Migrations::class, 'run']
);

Plugin::init();
