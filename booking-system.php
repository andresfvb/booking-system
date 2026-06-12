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



require_once __DIR__ . '/vendor/autoload.php';

BookingSystem\Core\Plugin::init();

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

use BookingSystem\Core\Plugin;

Plugin::init();