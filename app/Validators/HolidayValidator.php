<?php

namespace BookingSystem\Validators;

use BookingSystem\Services\BookingRulesService;
use BookingSystem\Exceptions\BookingValidationException;

class HolidayValidator
{
    public function validate(\DateTime $date): void
    {
        $rules = new BookingRulesService();

        $dayOfWeek = $date->format('w');

        if ($dayOfWeek == 0) {
            throw new BookingValidationException(
                'Reservations are not allowed on Sundays.'
            );
        }

        $holidays = $rules->getHolidays();

        if (
            in_array(
                $date->format('Y-m-d'),
                $holidays
            )
        ) {
            throw new BookingValidationException(
                'Reservations are not allowed on holidays.'
            );
        }
    }
}