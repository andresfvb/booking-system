<?php

namespace BookingSystem\Database;

defined('ABSPATH') || exit;

class Schema
{
    public static function reservationsTable(): string
    {
        global $wpdb;

        return $wpdb->prefix . 'booking_reservations';
    }

    public static function servicesTable(): string
    {
        global $wpdb;

        return $wpdb->prefix . 'booking_services';
    }
}