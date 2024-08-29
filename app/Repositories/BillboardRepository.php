<?php

namespace App\Repositories;

use App\Models\BillboardEntity;
use App\Repositories\Base\BaseRepository;
use Illuminate\Http\Request;

/**
 * BillboardRepository
 */
class BillboardRepository extends BaseRepository
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
    public function __construct(BillboardEntity $billboardentity)
    {
        parent::__construct($billboardentity);
    }


}
