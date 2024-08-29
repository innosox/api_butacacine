<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\BookingServiceInterface;
use Illuminate\Http\Request;

class BookingController extends Controller
{


    protected $bookingService;

    public function __construct(BookingServiceInterface $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function cancel(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|integer',
        ]);

        $this->bookingService->cancelBooking($request->booking_id);

        return response()->json(['message' => 'Reserva cancelada con éxito']);
    }

    public function getTerrorBookings(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $bookings = $this->bookingService->getTerrorBookingsBetweenDates($startDate, $endDate);
        return response()->json($bookings);
    }

    public function getAvailableAndOccupiedSeats(Request $request)
    {
        $request->validate([
            'room_id' => 'required|integer',
        ]);

        $seats = $this->bookingService->getAvailableAndOccupiedSeats($request->room_id);
        return response()->json($seats);
    }


}
