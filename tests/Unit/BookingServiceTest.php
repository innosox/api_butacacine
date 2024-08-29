<?php

namespace Tests\Unit;

use App\Models\BillboardEntity;
use Tests\TestCase;
use App\Services\BookingService;
use App\Models\SeatEntity;
use App\Models\BookingEntity;
use App\Models\MovieEntity;
use App\Models\RoomEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $bookingService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bookingService = new BookingService();
    }

    public function test_cancel_booking()
    {
        // Crear datos de prueba
        $seat = SeatEntity::factory()->create(['status' => false]);
        $booking = BookingEntity::factory()->create(['seat_id' => $seat->id]);

        // Ejecutar el servicio
        $this->bookingService->cancelBooking($booking->id);

        // Verificar que la reserva fue cancelada y la butaca habilitada
        $this->assertDatabaseMissing('booking_entities', ['id' => $booking->id]);
        $this->assertDatabaseHas('seat_entities', ['id' => $seat->id, 'status' => true]);
    }

    public function test_get_terror_bookings_between_dates()
    {
        // Crear datos de prueba
        $movie = MovieEntity::factory()->create(['genre' => 'HORROR']);
        $room = RoomEntity::factory()->create();
        $billboard = BillboardEntity::factory()->create(['movie_id' => $movie->id, 'room_id' => $room->id]);
        $booking = BookingEntity::factory()->create(['billboard_id' => $billboard->id, 'date' => now()]);

        // Ejecutar el servicio
        $bookings = $this->bookingService->getTerrorBookingsBetweenDates(now()->subDay(), now()->addDay());

        // Verificar que se obtiene la reserva de la película de terror
        $this->assertCount(1, $bookings);
        $this->assertEquals($booking->id, $bookings[0]['id']);
    }



    public function test_get_available_and_occupied_seats_for_today()
{
    // Crear datos de prueba
    $room = RoomEntity::factory()->create();
    $movie = MovieEntity::factory()->create();
    $billboard = BillboardEntity::factory()->create([
        'room_id' => $room->id,
        'movie_id' => $movie->id,
        'date' => now(),  // Asegúrate de que la cartelera sea para hoy
    ]);

    SeatEntity::factory()->count(10)->create([
        'room_id' => $room->id,
        'status' => true,
    ]);

    SeatEntity::factory()->count(5)->create([
        'room_id' => $room->id,
        'status' => false,
    ]);

    // Ejecutar el servicio
    $seats = $this->bookingService->getAvailableAndOccupiedSeats($room->id);

    // Verificar que los conteos de butacas disponibles y ocupadas son correctos
    $this->assertEquals(10, $seats['available']);
    $this->assertEquals(5, $seats['occupied']);
}

    public function test_get_available_and_occupied_seats()
    {
        // Crear datos de prueba
        $room = RoomEntity::factory()->create();
        $movie = MovieEntity::factory()->create();
        $billboard = BillboardEntity::factory()->create([
            'room_id' => $room->id,
            'movie_id' => $movie->id,
            'date' => now(),  // Asegúrate de que la cartelera sea para hoy
        ]);

        SeatEntity::factory()->count(10)->create([
            'room_id' => $room->id,
            'status' => true,
        ]);

        SeatEntity::factory()->count(5)->create([
            'room_id' => $room->id,
            'status' => false,
        ]);

        // Ejecutar el servicio
        $seats = $this->bookingService->getAvailableAndOccupiedSeats($room->id);

        //dd($seats);

        // Verificar que los conteos de butacas disponibles y ocupadas son correctos
        $this->assertEquals(10, $seats['available']);
        $this->assertEquals(5, $seats['occupied']);
    }

}

