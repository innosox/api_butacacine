<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BillboardEntity extends BaseEntity
{
    use HasFactory;

    protected $table = 'billboard_entities';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable =
    [
        'date',
        'start_time',
        'end_time',
        'movie_id',
        'room_id'
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
     * movie
     *
     * @return BelongsTo
     */
    public function movie() : BelongsTo
    {
        return $this->belongsTo(MovieEntity::class, 'movie_id');
    }

    /**
     * room
     *
     * @return BelongsTo
     */
    public function room() : BelongsTo
    {
        return $this->belongsTo(RoomEntity::class, 'room_id');
    }

    /**
     * bookings
     *
     * @return HasMany
     */
    public function bookings() : HasMany
    {
        return $this->hasMany(BookingEntity::class, 'billboard_id');
    }


}
