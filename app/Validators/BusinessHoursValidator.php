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
                error_log('Reservation Hour: ' . $hour);
error_log('Opening Hour: ' . $rules->getOpeningHour());
error_log('Closing Hour: ' . $rules->getClosingHour());

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