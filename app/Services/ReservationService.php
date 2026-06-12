<?php

namespace BookingSystem\Services;

use BookingSystem\DTO\ReservationRequest;
use BookingSystem\Repositories\ServiceRepository;
use BookingSystem\Repositories\ReservationRepository;
use BookingSystem\Validators\ReservationValidator;
use RuntimeException;

defined('ABSPATH') || exit;

class ReservationService
{
    public function __construct(
        private ReservationValidator $validator = new ReservationValidator(),
        private ReservationRepository $reservationRepository = new ReservationRepository(),
        private ServiceRepository $serviceRepository = new ServiceRepository()
    ) {
    }

    public function create(
        ReservationRequest $request
    ): int {

        /*
         * Validaciones
         */
        $this->validator->validate(
            $request
        );

        /*
         * Servicio
         */
        $service = $this->serviceRepository->find(
            $request->serviceId
        );

        if (!$service) {
            throw new RuntimeException(
                'Service not found.'
            );
        }

        /*
         * Hora fin
         */
        $endDateTime =
            clone $request->startDateTime;

        $endDateTime->modify(
            '+' . $service->duration_minutes . ' minutes'
        );

        /*
         * Persistencia
         */
        return $this->reservationRepository->create([
            'user_id' => $request->userId,

            'service_id' => $request->serviceId,

            'professional_id' => $request->professionalId,

            'start_datetime' =>
                $request
                    ->startDateTime
                    ->format('Y-m-d H:i:s'),

            'end_datetime' =>
                $endDateTime
                    ->format('Y-m-d H:i:s'),

            'status' => 'active',

            'amount' => $service->price,

            'refund_amount' => 0,

            'created_at' => current_time('mysql'),

            'updated_at' => current_time('mysql'),
        ]);
    }
}