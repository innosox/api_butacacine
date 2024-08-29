<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerEntity extends BaseEntity
{
    use HasFactory;

    protected $table = 'customer_entities';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable =
    [
        'document_number',
        'name',
        'lastname',
        'age',
        'phone_number',
        'email',
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
