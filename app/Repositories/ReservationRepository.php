<?php

namespace BookingSystem\Repositories;

use BookingSystem\Database\Schema;

defined('ABSPATH') || exit;

class ReservationRepository
{
    private string $table;

    public function __construct()
    {
        $this->table = Schema::reservationsTable();
    }

    public function create(array $data): int
    {
        global $wpdb;

        $wpdb->insert(
            $this->table,
            $data
        );

        return (int) $wpdb->insert_id;
    }

    public function find(int $id): ?object
    {
        global $wpdb;

        $reservation = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$this->table} WHERE id = %d",
                $id
            )
        );

        return $reservation ?: null;
    }

    public function cancel(
        int $id,
        float $refundAmount
    ): bool {

        global $wpdb;

        $updated = $wpdb->update(
            $this->table,
            [
                'status' => 'cancelled',
                'refund_amount' => $refundAmount,
                'updated_at' => current_time('mysql')
            ],
            [
                'id' => $id
            ]
        );

        return $updated !== false;
    }

    public function countFutureReservations(
        int $userId
    ): int {

        global $wpdb;

        return (int) $wpdb->get_var(
            $wpdb->prepare(
                "
                SELECT COUNT(*)
                FROM {$this->table}
                WHERE user_id = %d
                AND status = 'active'
                AND start_datetime > %s
                ",
                $userId,
                current_time('mysql')
            )
        );
    }

    public function hasOverlap(
        int $professionalId,
        string $startDateTime,
        string $endDateTime
    ): bool {

        global $wpdb;

        $count = (int) $wpdb->get_var(
            $wpdb->prepare(
                "
                SELECT COUNT(*)
                FROM {$this->table}
                WHERE professional_id = %d
                AND status = 'active'
                AND start_datetime < %s
                AND end_datetime > %s
                ",
                $professionalId,
                $endDateTime,
                $startDateTime
            )
        );

        return $count > 0;
    }

    public function getByUserAndRange(
        int $userId,
        string $startDate,
        string $endDate
    ): array {

        global $wpdb;

        return $wpdb->get_results(
            $wpdb->prepare(
                "
                SELECT *
                FROM {$this->table}
                WHERE user_id = %d
                AND start_datetime BETWEEN %s AND %s
                ORDER BY start_datetime ASC
                ",
                $userId,
                $startDate,
                $endDate
            )
        ) ?: [];
    }

    public function getFutureReservationsByUser(
        int $userId
    ): array {

        global $wpdb;

        return $wpdb->get_results(
            $wpdb->prepare(
                "
                SELECT *
                FROM {$this->table}
                WHERE user_id = %d
                AND status = 'active'
                AND start_datetime > %s
                ORDER BY start_datetime ASC
                ",
                $userId,
                current_time('mysql')
            )
        ) ?: [];
    }

    public function exists(int $id): bool
    {
        return $this->find($id) !== null;
    }

    public function delete(int $id): bool
    {
        global $wpdb;

        $deleted = $wpdb->delete(
            $this->table,
            [
                'id' => $id
            ]
        );

        return $deleted !== false;
    }

    public function updateStatus(
        int $reservationId,
        string $status
    ): bool {

        global $wpdb;

        return (bool) $wpdb->update(
            $this->table,
            [
                'status' => $status,
                'updated_at' => current_time('mysql')
            ],
            [
                'id' => $reservationId
            ]
        );
    }
}