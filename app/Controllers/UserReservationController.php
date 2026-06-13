<?php

namespace BookingSystem\Controllers;

use WP_REST_Request;
use WP_REST_Response;

use BookingSystem\Repositories\ReservationRepository;

class UserReservationController
{
    public function index(
        WP_REST_Request $request
    ): WP_REST_Response {

        $userId = (int) $request['id'];

        $startDate =
            $request->get_param('start_date')
            ??
            date('Y-m-01');

        $endDate =
            $request->get_param('end_date')
            ??
            date('Y-m-t');

        $reservations =
            (new ReservationRepository())
                ->getByUserAndRange(
                    $userId,
                    $startDate . ' 00:00:00',
                    $endDate . ' 23:59:59'
                );

        return new WP_REST_Response(
            [
                'success' => true,
                'data' => $reservations
            ]
        );
    }
}