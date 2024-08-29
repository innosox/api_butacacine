<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomEntity extends BaseEntity
{
    use HasFactory;

    protected $table = 'room_entities';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable =
    [
        'name',
        'number',
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
     * seats
     *
     * @return HasMany
     */
    public function seats() : HasMany
    {
        return $this->hasMany(SeatEntity::class, 'room_id');
    }

    /**
     * billboards
     *
     * @return HasMany
     */
    public function billboards() : HasMany
    {
        return $this->hasMany(BillboardEntity::class, 'room_id');
    }

}
