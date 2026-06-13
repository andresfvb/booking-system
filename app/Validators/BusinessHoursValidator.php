<?php

namespace BookingSystem\Validators;

use BookingSystem\Services\BookingRulesService;
use BookingSystem\Exceptions\BookingValidationException;

class BusinessHoursValidator
{
    public function validate(\DateTime $date): void
    {
        $rules = new BookingRulesService();

        $hour = $date->format('H:i');

        if (
            $hour < $rules->getOpeningHour()
            ||
            $hour > $rules->getClosingHour()
        ) {
            throw new BookingValidationException(
                'Reservation outside business hours.'
            );
        }

    }
}