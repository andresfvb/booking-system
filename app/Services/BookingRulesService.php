<?php

namespace BookingSystem\Services;

defined('ABSPATH') || exit;

class BookingRulesService
{
    public function getRules(): array
    {
        return [

            'timezone' => get_field(
                'timezone',
                'option'
            ) ?: 'America/Bogota',

            'opening_hour' => get_field(
                'opening_hour',
                'option'
            ) ?: '07:00',

            'closing_hour' => get_field(
                'closing_hour',
                'option'
            ) ?: '19:00',

            'minimum_advance_hours' => (int)
                get_field(
                    'minimum_advance_hours',
                    'option'
                ),

            'max_active_reservations' => (int)
                get_field(
                    'max_active_reservations',
                    'option'
                ),
        ];
    }
}