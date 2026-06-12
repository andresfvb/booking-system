<?php

namespace BookingSystem\Validators;

use BookingSystem\DTO\ReservationRequest;

class ReservationValidator
{
    public function validate(
        ReservationRequest $request
    ): void {

        (new HolidayValidator())
            ->validate(
                $request->startDateTime
            );

        (new BusinessHoursValidator())
            ->validate(
                $request->startDateTime
            );

        (new AdvanceTimeValidator())
            ->validate(
                $request->startDateTime
            );

        (new ReservationLimitValidator())
            ->validate(
                $request->userId
            );

        (new ReservationOverlapValidator())
            ->validate(
                $request
            );
    }
}