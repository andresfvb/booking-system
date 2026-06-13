<?php

namespace BookingSystem\Routes;

use BookingSystem\Controllers\ReservationController;
use BookingSystem\Controllers\CancellationController;
use BookingSystem\Controllers\UserReservationController;

defined('ABSPATH') || exit;

class ApiRoutes
{
    public static function register(): void
    {
        register_rest_route(
            'booking/v1',
            '/reservations',
            [
                'methods' => 'POST',
                'callback' => [new ReservationController(), 'store'],
                'permission_callback' => '__return_true'
            ]
        );

        register_rest_route(
            'booking/v1',
            '/reservations/(?P<id>\d+)/cancel',
            [
                'methods' => 'POST',
                'callback' => [new CancellationController(), 'cancel'],
                'permission_callback' => '__return_true'
            ]
        );

        register_rest_route(
            'booking/v1',
            '/users/(?P<id>\d+)/reservations',
            [
                'methods' => 'GET',
                'callback' => [new UserReservationController(), 'index'],
                'permission_callback' => '__return_true'
            ]
        );
    }
}