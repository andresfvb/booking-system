<?php

namespace BookingSystem\Services;

class AppointmentTimeService
{
    public function calculateEndDate(
        \DateTime $start,
        int $durationMinutes
    ): \DateTime {

        $end = clone $start;

        $end->modify(
            '+' . $durationMinutes . ' minutes'
        );

        return $end;
    }
}