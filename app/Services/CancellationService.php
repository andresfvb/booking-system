<?php

namespace BookingSystem\Services;

use RuntimeException;
use BookingSystem\DTO\CancelReservationRequest;
use BookingSystem\DTO\CancellationResponse;
use BookingSystem\Repositories\ServiceRepository;
use BookingSystem\Repositories\ReservationRepository;

defined('ABSPATH') || exit;

class CancellationService
{
    public function __construct(
        private ReservationRepository $reservationRepository = new ReservationRepository(),
        private ServiceRepository $serviceRepository = new ServiceRepository(),
        private RefundCalculator $refundCalculator = new RefundCalculator()
    ) {
    }

    public function cancel(
        CancelReservationRequest $request
    ): CancellationResponse {

        /*
         * Buscar reserva
         */
        $reservation =
            $this->reservationRepository->find(
                $request->reservationId
            );

        if (!$reservation) {
            throw new RuntimeException(
                'Reservation not found.'
            );
        }

        /*
         * Ya cancelada
         */
        if (
            $reservation->status === 'cancelled'
        ) {
            throw new RuntimeException(
                'Reservation already cancelled.'
            );
        }

        /*
         * Servicio
         */
        $service =
            $this->serviceRepository->find(
                $reservation->service_id
            );

        if (!$service) {
            throw new RuntimeException(
                'Service not found.'
            );
        }

        /*
         * Calcular reembolso
         */
        $refundAmount =
            $this->refundCalculator->calculate(
                $reservation,
                $service
            );

        /*
         * Cancelar
         */
        $this->reservationRepository->cancel(
            $reservation->id,
            $refundAmount
        );

        return new CancellationResponse(
            reservationId: $reservation->id,
            refundAmount: $refundAmount,
            status: 'cancelled'
        );
    }
}