<?php

namespace App\Services\Interfaces;

interface BillboardServiceInterface
{
    public function cancelBillboard(int $billboardId): array;
}

