<?php

namespace BookingSystem\Database;

defined('ABSPATH') || exit;

class Seed
{
    public static function run()
    {
        global $wpdb;

        $table = Schema::servicesTable();

        $exists = $wpdb->get_var(
            "SELECT COUNT(*) FROM {$table}"
        );

        if ($exists > 0) {
            return;
        }

        $services = [
            [
                'name' => 'General Consultation',
                'duration_minutes' => 60,
                'price' => 100,
                'non_refundable' => 0,
            ],
            [
                'name' => 'Premium Consultation',
                'duration_minutes' => 90,
                'price' => 200,
                'non_refundable' => 0,
            ],
            [
                'name' => 'Special Procedure',
                'duration_minutes' => 120,
                'price' => 300,
                'non_refundable' => 1,
            ],
        ];

        foreach ($services as $service) {
            $wpdb->insert(
                $table,
                $service
            );
        }
    }
}