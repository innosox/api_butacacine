<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\BillboardService;
use App\Models\BillboardEntity;
use App\Models\BookingEntity;
use App\Models\SeatEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class BillboardServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $billboardService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->billboardService = new BillboardService();
    }

    public function test_cancel_billboard()
    {
        // Crear datos de prueba
        $seat = SeatEntity::factory()->create(['status' => false]);
        $billboard = BillboardEntity::factory()->create(['date' => now()->addDay()]);
        $booking = BookingEntity::factory()->create(['billboard_id' => $billboard->id, 'seat_id' => $seat->id]);

        // Ejecutar el servicio
        $affectedCustomers = $this->billboardService->cancelBillboard($billboard->id);

        // Verificar que la cartelera y las reservas fueron canceladas, y las butacas habilitadas
        $this->assertDatabaseMissing('billboard_entities', ['id' => $billboard->id]);
        $this->assertDatabaseMissing('booking_entities', ['id' => $booking->id]);
        $this->assertDatabaseHas('seat_entities', ['id' => $seat->id, 'status' => true]);

        // Verificar que los clientes afectados son retornados
        $this->assertCount(1, $affectedCustomers);
        $this->assertEquals($booking->customer->id, $affectedCustomers[0]->id);
    }

    public function test_cancel_billboard_throws_exception_for_past_dates()
    {
        // Crear datos de prueba
        $billboard = BillboardEntity::factory()->create(['date' => now()->subDay()]);

        // Ejecutar el servicio y esperar una excepción
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('No se puede cancelar funciones de la cartelera con fecha anterior a la actual');

        $this->billboardService->cancelBillboard($billboard->id);
    }


}
