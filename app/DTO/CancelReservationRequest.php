<?php

namespace BookingSystem\DTO;

class CancelReservationRequest
{
    public function __construct(
        public int $reservationId,
        public float $refundAmount,
        public string $status
    ) {
    }
}