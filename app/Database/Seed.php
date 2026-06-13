<?php

namespace BookingSystem\Database;

defined('ABSPATH') || exit;

class Seed
{
public function run(): void
    {
        $file = BOOKING_SYSTEM_PATH .
            'storage/seed.json';

        if (!file_exists($file)) {
            return;
        }

        $content = file_get_contents($file);

        $data = json_decode(
            $content,
            true
        );

        if (!$data) {
            return;
        }

        $this->seedServices(
            $data['services'] ?? []
        );
    }

    private function seedServices(
        array $services
    ): void {

        global $wpdb;

        $table =
            Schema::servicesTable();

        foreach ($services as $service) {

            $exists = $wpdb->get_var(
                $wpdb->prepare(
                    "
                    SELECT id
                    FROM {$table}
                    WHERE name = %s
                    ",
                    $service['name']
                )
            );

            if ($exists) {
                continue;
            }

            $wpdb->insert(
                $table,
                [
                    'name' =>
                        $service['name'],

                    'duration_minutes' =>
                        $service['duration_minutes'],

                    'price' =>
                        $service['price'],

                    'non_refundable' =>
                        $service['non_refundable']
                            ? 1
                            : 0
                ]
            );
        }
    }
}