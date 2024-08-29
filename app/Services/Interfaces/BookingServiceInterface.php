<?php

namespace App\Services\Interfaces;

interface BookingServiceInterface
{
    public function cancelBooking(int $bookingId): void;
    public function getTerrorBookingsBetweenDates(string $startDate, string $endDate): array;
    public function getAvailableAndOccupiedSeats(int $roomId): array;
}
