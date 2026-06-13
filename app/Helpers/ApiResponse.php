<?php

namespace BookingSystem\Helpers;

use WP_REST_Response;

defined('ABSPATH') || exit;

class ApiResponse
{
    public static function success(
        mixed $data = null,
        int $status = 200
    ): WP_REST_Response {

        return new WP_REST_Response(
            [
                'success' => true,
                'data' => $data
            ],
            $status
        );
    }

    public static function error(
        string $message,
        int $status = 400,
        mixed $errors = null
    ): WP_REST_Response {

        return new WP_REST_Response(
            [
                'success' => false,
                'message' => $message,
                'errors' => $errors
            ],
            $status
        );
    }
}