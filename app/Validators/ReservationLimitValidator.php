<?php

namespace BookingSystem\Validators;

use BookingSystem\Repositories\ReservationRepository;
use BookingSystem\Services\BookingRulesService;
use BookingSystem\Exceptions\BookingValidationException;

class ReservationLimitValidator
{
    public function validate(
        int $userId
    ): void {

        $repository =
            new ReservationRepository();

        $activeReservations =
            $repository->countFutureReservations(
                $userId
            );

        $rules =
            new BookingRulesService();

        if (
            $activeReservations >=
            $rules->getMaxActiveReservations()
        ) {

            throw new BookingValidationException(
                'User reached maximum active reservations.'
            );
        }
    }
}