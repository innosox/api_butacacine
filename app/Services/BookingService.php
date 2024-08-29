<?php

namespace App\Services;

use App\Models\BookingEntity;
use App\Models\SeatEntity;
use App\Services\Interfaces\BookingServiceInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class BookingService implements BookingServiceInterface
{
    public function cancelBooking(int $bookingId): void
    {
        DB::transaction(function () use ($bookingId) {
            $booking = BookingEntity::findOrFail($bookingId);
            $seat = $booking->seat;
            $seat->status = true; // Habilitar la butaca
            $seat->save();

            $booking->delete(); // Cancelar la reserva
        });
    }

    public function getTerrorBookingsBetweenDates(string $startDate, string $endDate): array
    {
        return BookingEntity::whereHas('billboard.movie', function ($query) {
            $query->where('genre', 'HORROR');
        })->whereBetween('date', [$startDate, $endDate])->get()->toArray();
    }

    public function getAvailableAndOccupiedSeats(int $roomId): array
    {
        $today = now()->startOfDay();  // Fecha de inicio del día actual
        $tomorrow = now()->endOfDay(); // Fecha de fin del día actual

        // Obtenemos todas las butacas para la sala y la cartelera del día actual
        $seats = SeatEntity::where('room_id', $roomId)
            ->whereHas('room.billboards', function ($query) use ($today, $tomorrow) {
                $query->whereBetween('date', [$today, $tomorrow]);
            })->get();

        // Contamos las butacas disponibles y ocupadas
        $availableSeats = $seats->where('status', true)->count();
        $occupiedSeats = $seats->where('status', false)->count();

        return [
            'available' => $availableSeats,
            'occupied' => $occupiedSeats,
        ];
    }

}


