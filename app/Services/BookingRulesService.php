<?php

namespace BookingSystem\Services;

defined('ABSPATH') || exit;

class BookingRulesService
{
    public function getTimezone(): string
    {
        return get_field(
            'timezone',
            'option'
        ) ?: 'America/Bogota';
    }

    public function getOpeningHour(): string
    {
        return get_field(
            'opening_hour',
            'option'
        ) ?: '07:00';
    }

    public function getClosingHour(): string
    {
        return get_field(
            'closing_hour',
            'option'
        ) ?: '19:00';
    }

    public function getMinimumAdvanceHours(): int
    {
        return (int) (
            get_field(
                'minimum_advance_hours',
                'option'
            ) ?: 2
        );
    }

    public function getMaxActiveReservations(): int
    {
        return (int) (
            get_field(
                'max_active_reservations',
                'option'
            ) ?: 3
        );
    }

    public function getRefundRules(): array
    {
        return [

            'standard' => [

                'full_hours' => (int)
                    get_field(
                        'standard_full_refund_hours',
                        'option'
                    ),

                'partial_hours' => (int)
                    get_field(
                        'standard_partial_refund_hours',
                        'option'
                    ),

                'partial_percentage' => (int)
                    get_field(
                        'standard_partial_refund_percentage',
                        'option'
                    ),
            ],

            'premium' => [

                'full_hours' => (int)
                    get_field(
                        'premium_full_refund_hours',
                        'option'
                    ),

                'partial_hours' => (int)
                    get_field(
                        'premium_partial_refund_hours',
                        'option'
                    ),

                'partial_percentage' => (int)
                    get_field(
                        'premium_partial_refund_percentage',
                        'option'
                    ),
            ]
        ];
    }

    public function getHolidays(): array
    {
        $holidays = get_field(
            'holidays',
            'option'
        );

        if (empty($holidays)) {
            return [];
        }

        return array_map(
            fn($holiday) => $holiday['date'],
            $holidays
        );
    }

    public function getRules(): array
    {
        return [

            'timezone' => $this->getTimezone(),

            'opening_hour' => $this->getOpeningHour(),

            'closing_hour' => $this->getClosingHour(),

            'minimum_advance_hours' => $this->getMinimumAdvanceHours(),

            'max_active_reservations' => $this->getMaxActiveReservations(),

            'refunds' => $this->getRefundRules(),

            'holidays' => $this->getHolidays()
        ];
    }
}