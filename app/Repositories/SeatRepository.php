<?php

namespace App\Repositories;

use App\Models\SeatEntity;
use App\Repositories\Base\BaseRepository;
use Illuminate\Http\Request;

/**
 * seatRepository
 */
class SeatRepository extends BaseRepository
{

    /**
     * relations
     *
     * @var array
     */
    protected $relations = [];

    /**
     * __construct
     *
     * @return void
     */
    public function __construct(SeatEntity $seatentity)
    {
        parent::__construct($seatentity);
    }


}
