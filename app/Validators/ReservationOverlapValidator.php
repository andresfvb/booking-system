<?php

namespace BookingSystem\Validators;

use BookingSystem\DTO\ReservationRequest;
use BookingSystem\Repositories\ServiceRepository;
use BookingSystem\Repositories\ReservationRepository;
use BookingSystem\Exceptions\BookingValidationException;

class ReservationOverlapValidator
{
    public function validate(
        ReservationRequest $request
    ): void {

        $serviceRepository =
            new ServiceRepository();

        $reservationRepository =
            new ReservationRepository();

        $service =
            $serviceRepository->find(
                $request->serviceId
            );

        $start =
            clone $request->startDateTime;

        $end =
            clone $request->startDateTime;

        $end->modify(
            '+' .
            $service->duration_minutes .
            ' minutes'
        );

        $hasOverlap =
            $reservationRepository->hasOverlap(
                $request->professionalId,
                $start->format('Y-m-d H:i:s'),
                $end->format('Y-m-d H:i:s')
            );

        if ($hasOverlap) {

            throw new BookingValidationException(
                'The professional already has a reservation during that time slot.'
            );
        }
    }
}