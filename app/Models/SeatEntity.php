<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeatEntity extends BaseEntity
{
    use HasFactory;

    protected $table = 'seat_entities';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable =
    [
        'number',
        'row_number',
        'room_id',
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
     * room
     *
     * @return BelongsTo
     */
    public function room() : BelongsTo
    {
        return $this->belongsTo(RoomEntity::class, 'room_id');
    }

}
