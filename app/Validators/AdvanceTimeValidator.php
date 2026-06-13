<?php

namespace BookingSystem\Validators;

use BookingSystem\Services\BookingRulesService;
use BookingSystem\Exceptions\BookingValidationException;

class AdvanceTimeValidator
{
    public function validate(
        \DateTime $date
    ): void {

        $rules = new BookingRulesService();

        $minimumHours =
            $rules->getMinimumAdvanceHours();

        $now = new \DateTime(
            'now',
            new \DateTimeZone(
                $rules->getTimezone()
            )
        );

        $diffSeconds =
            $date->getTimestamp()
            -
            $now->getTimestamp();

        $hours =
            $diffSeconds / 3600;

error_log('Now TZ: ' . $now->getTimezone()->getName());
error_log('Reservation TZ: ' . $date->getTimezone()->getName());

error_log('Now TS: ' . $now->getTimestamp());
error_log('Reservation TS: ' . $date->getTimestamp());

        if ($hours < $minimumHours) {

            throw new BookingValidationException(
                "Reservation requires at least {$minimumHours} hours advance notice."
            );
        }
    }
}