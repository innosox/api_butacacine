<?php

namespace App\Http\Controllers;

use App\Exceptions\Custom\ConflictException;
use App\Models\SeatEntity;
use App\Repositories\SeatRepository;
use App\Requests\StoreSeatRequest;
use App\Requests\UpdateSeatRequest;
use App\Traits\RestResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;

class SeatController extends Controller
{

    use RestResponse;


    /**
     * @var SeatRepository
     */
    private $seatRepository;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        SeatRepository $seatRepository

        )
    {
        $this->seatRepository = $seatRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        return $this->success(
            $this->seatRepository->all($request)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSeatRequest $request
     * @return JsonResponse
     */
    public function store(StoreSeatRequest $request) : JsonResponse
    {
        DB::beginTransaction();
        try {
            $seatentity = new SeatEntity($request->all());
            $seatentity = $this->seatRepository->save($seatentity);
            DB::commit();
            return $this->success($seatentity);

        } catch (Throwable $e) {
            DB::rollBack();
            throw new ConflictException($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param SeatEntity $seatentity
     * @return JsonResponse
     */
    public function show(SeatEntity $seatentity) : JsonResponse
    {
        return $this->success(
            $this->seatRepository->find($seatentity->id)
        );
    }

    public function update(UpdateSeatRequest $request, SeatEntity $seatentity)
    {

        $seatentity->fill($request->all());

        if ($seatentity->isClean()) {
            return $this->information(__('messages.nochange'));
        }

        return $this->success(
            $this->seatRepository->save($seatentity)
        );

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param SeatEntity $seatentity
     * @return JsonResponse
     */
    public function destroy(SeatEntity $seatentity) : JsonResponse
    {
        return $this->success(
            $this->seatRepository->destroy($seatentity)
        );
    }

}
