<?php

namespace BookingSystem\DTO;

class ReservationRequest
{
    public function __construct(
        public int $userId,
        public int $serviceId,
        public int $professionalId,
        public int $id,
        public string $status,
        public string $message,
        public \DateTime $startDateTime
    ) {}
}