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

        if ($hours < $minimumHours) {

            throw new BookingValidationException(
                "Reservation requires at least {$minimumHours} hours advance notice."
            );
        }
    }
}