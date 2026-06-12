<?php

namespace BookingSystem\Database;

defined('ABSPATH') || exit;

class Migrations
{
    public static function run(): void
    {
        self::createServicesTable();

        self::createReservationsTable();

        Seed::run();

        update_option(
            'booking_system_db_version',
            BOOKING_SYSTEM_DB_VERSION
        );
    }

    private static function createServicesTable(): void
    {
        global $wpdb;

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $table = Schema::servicesTable();

        $charset = $wpdb->get_charset_collate();

        $sql = "
            CREATE TABLE {$table} (
                id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL,
                duration_minutes INT NOT NULL,
                price DECIMAL(10,2) NOT NULL,
                non_refundable TINYINT(1) DEFAULT 0,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) {$charset};
        ";

        dbDelta($sql);
    }

    private static function createReservationsTable(): void
    {
        global $wpdb;

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $table = Schema::reservationsTable();

        $charset = $wpdb->get_charset_collate();

        $sql = "
            CREATE TABLE {$table} (
                id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

                user_id BIGINT UNSIGNED NOT NULL,
                service_id BIGINT UNSIGNED NOT NULL,

                professional_id BIGINT UNSIGNED NOT NULL,

                start_datetime DATETIME NOT NULL,
                end_datetime DATETIME NOT NULL,

                status VARCHAR(20) DEFAULT 'active',

                amount DECIMAL(10,2) NOT NULL,
                refund_amount DECIMAL(10,2) DEFAULT 0,

                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,

                PRIMARY KEY (id),

                KEY idx_user (user_id),
                KEY idx_service (service_id),
                KEY idx_professional (professional_id),
                KEY idx_start (start_datetime)
            ) {$charset};
        ";

        dbDelta($sql);
    }
    
}