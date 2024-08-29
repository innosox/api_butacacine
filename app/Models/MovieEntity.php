<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieEntity extends BaseEntity
{
    use HasFactory;

    protected $table = 'movie_entities';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable =
    [
        'name',
        'genre',
        'allowed_age',
        'length_minutes',
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

}
