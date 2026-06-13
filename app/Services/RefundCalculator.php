<?php

namespace BookingSystem\Services;

use BookingSystem\Repositories\UserRepository;

defined('ABSPATH') || exit;

class RefundCalculator
{
    public function __construct(
        private UserRepository $userRepository = new UserRepository(),
        private BookingRulesService $rules = new BookingRulesService()
    ) {
    }

    public function calculate(
        object $reservation,
        object $service
    ): float {

        /*
         * Servicio no reembolsable
         */
        if ((int) $service->non_refundable === 1) {
            return 0;
        }

        /*
         * Horas restantes
         */
        $hoursUntilReservation =
            $this->calculateHoursUntilReservation(
                $reservation->start_datetime
            );
        /*
        * Tipo de plan
        */
        $plan = $this->userRepository->getPlan(
            $reservation->user_id
        );

        switch ($plan) {

            case 'premium':
                return $this->calculatePremiumRefund(
                    (float) $reservation->amount,
                    $hoursUntilReservation
                );

            case 'standard':
            default:
                return $this->calculateStandardRefund(
                    (float) $reservation->amount,
                    $hoursUntilReservation
                );
        }
    }

    private function calculateHoursUntilReservation(
        string $reservationDate
    ): float {

        $reservationDateTime =
            new \DateTime(
                $reservationDate
            );

        $now =
            new \DateTime();

        $seconds =
            $reservationDateTime->getTimestamp()
            -
            $now->getTimestamp();

        return $seconds / 3600;
    }

    private function calculateStandardRefund(
        float $amount,
        float $hours
    ): float {

        $rules =
            $this->rules->getRefundRules();

        $config =
            $rules['standard'];

        if (
            $hours >=
            $config['full_hours']
        ) {
            return $amount;
        }

        if (
            $hours >=
            $config['partial_hours']
        ) {

            return round(
                $amount *
                (
                    $config['partial_percentage']
                    / 100
                ),
                2
            );
        }

        return 0;
    }

    private function calculatePremiumRefund(
        float $amount,
        float $hours
    ): float {

        $rules =
            $this->rules->getRefundRules();

        $config =
            $rules['premium'];

        if (
            $hours >=
            $config['full_hours']
        ) {
            return $amount;
        }

        if (
            $hours >=
            $config['partial_hours']
        ) {

            return round(
                $amount *
                (
                    $config['partial_percentage']
                    / 100
                ),
                2
            );
        }

        return 0;
    }
}