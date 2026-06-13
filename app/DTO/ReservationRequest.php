<?php

namespace BookingSystem\DTO;

class ReservationRequest
{
    public function __construct(
        public int $userId,
        public int $serviceId,
        public int $professionalId,
        public \DateTime $startDateTime
    ) {}
}