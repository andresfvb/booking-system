<?php

namespace BookingSystem\Controllers;

use WP_REST_Request;
use WP_REST_Response;

use BookingSystem\DTO\CancelReservationRequest;
use BookingSystem\Services\CancellationService;

class CancellationController
{
    public function cancel(
        WP_REST_Request $request
    ): WP_REST_Response {

        try {

            $response =
                (new CancellationService())
                    ->cancel(
                        new CancelReservationRequest(
                            (int) $request['id']
                        )
                    );

            return new WP_REST_Response(
                [
                    'success' => true,
                    'reservation_id' => $response->reservationId,
                    'refund_amount' => $response->refundAmount,
                    'status' => $response->status
                ]
            );

        } catch (\Throwable $e) {

            return new WP_REST_Response(
                [
                    'success' => false,
                    'message' => $e->getMessage()
                ],
                400
            );
        }
    }
}