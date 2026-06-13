<?php

namespace BookingSystem\Controllers;

use WP_REST_Request;
use WP_REST_Response;

use BookingSystem\DTO\ReservationRequest;
use BookingSystem\Services\ReservationService;
use BookingSystem\Exceptions\BookingValidationException;

class ReservationController
{
    public function store(
        WP_REST_Request $request
    ): WP_REST_Response {

        try {

            $dto = new ReservationRequest(
                userId: (int) $request->get_param('user_id'),
                serviceId: (int) $request->get_param('service_id'),
                professionalId: (int) $request->get_param('professional_id'),
                startDateTime: new \DateTime(
                    $request->get_param('start_datetime')
                )
            );

            $reservationId =
                (new ReservationService())
                    ->create($dto);

            return new WP_REST_Response(
                [
                    'success' => true,
                    'reservation_id' => $reservationId
                ],
                201
            );

        } catch (BookingValidationException $e) {

            return new WP_REST_Response(
                [
                    'success' => false,
                    'message' => $e->getMessage()
                ],
                422
            );

        } catch (\Throwable $e) {

            return new WP_REST_Response(
                [
                    'success' => false,
                    'message' => $e->getMessage()
                ],
                500
            );
        }
    }
}