<?php

namespace BookingSystem\Repositories;

use BookingSystem\Database\Schema;

class ServiceRepository
{
    public function find(int $id): ?object
    {
        global $wpdb;

        $table = Schema::servicesTable();

        return $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$table} WHERE id = %d",
                $id
            )
        );
    }

    public function all(): array
    {
        global $wpdb;

        $table = Schema::servicesTable();

        return $wpdb->get_results(
            "SELECT * FROM {$table}"
        );
    }
}