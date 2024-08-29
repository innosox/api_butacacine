<?php

namespace App\Services;

use App\Models\BillboardEntity;
use App\Services\Interfaces\BillboardServiceInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class BillboardService implements BillboardServiceInterface
{
    public function cancelBillboard(int $billboardId): array
    {
        return DB::transaction(function () use ($billboardId) {
            $billboard = BillboardEntity::with('bookings.customer', 'bookings.seat')->findOrFail($billboardId);

            if ($billboard->date < now()) {
                throw new \Exception('No se puede cancelar funciones de la cartelera con fecha anterior a la actual');
            }

            $affectedCustomers = [];

            foreach ($billboard->bookings as $booking) {
                $seat = $booking->seat;
                $seat->status = true; // Habilitar la butaca
                $seat->save();

                $affectedCustomers[] = $booking->customer;
                $booking->delete(); // Cancelar la reserva
            }

            $billboard->delete(); // Cancelar la cartelera

            return $affectedCustomers;
        });
    }
}



