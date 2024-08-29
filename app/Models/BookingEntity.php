<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingEntity extends BaseEntity
{
    use HasFactory;

    protected $table = 'booking_entities';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable =
    [
        'date',
        'customer_id',
        'seat_id',
        'billboard_id',
    ];

    /**
     * hidden
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    /**
     * seat
     *
     * @return BelongsTo
     */
    public function seat(): BelongsTo
    {
        return $this->belongsTo(SeatEntity::class, 'seat_id');
    }

    /**
     * customer
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(CustomerEntity::class, 'customer_id');
    }

    /**
     * billboard
     *
     * @return BelongsTo
     */
    public function billboard(): BelongsTo
    {
        return $this->belongsTo(BillboardEntity::class, 'billboard_id');
    }

}
