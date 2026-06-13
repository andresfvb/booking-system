<?php

namespace BookingSystem\DTO;

class CancellationResponse
{
    public function __construct(
        public int $reservationId,
        public float $refundAmount,
        public string $status
    ) {
    }

    public function toArray(): array
    {
        return [
            'reservation_id' => $this->reservationId,
            'refund_amount' => $this->refundAmount,
            'status' => $this->status,
        ];
    }
}