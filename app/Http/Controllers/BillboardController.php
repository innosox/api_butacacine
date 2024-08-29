<?php

namespace App\Http\Controllers;

use App\Exceptions\Custom\ConflictException;
use App\Models\BillboardEntity;
use App\Repositories\BillboardRepository;
use App\Requests\StoreBillboardRequest;
use App\Requests\UpdateBillboardRequest;
use App\Services\Interfaces\BillboardServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class BillboardController extends Controller
{

    protected $billboardService;

    /**
     * @var BillboardRepository
     */
    private $billboardRepository;

    public function __construct(BillboardServiceInterface $billboardService, BillboardRepository $billboardRepository)
    {
        $this->billboardService = $billboardService;
        $this->billboardRepository = $billboardRepository;

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
            $this->billboardRepository->all($request)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSeatRequest $request
     * @return JsonResponse
     */
    public function store(StoreBillboardRequest $request) : JsonResponse
    {
        DB::beginTransaction();
        try {
            $billboard = new BillboardEntity($request->all());
            $billboard = $this->billboardRepository->save($billboard);
            DB::commit();
            return $this->success($billboard);

        } catch (Throwable $e) {
            DB::rollBack();
            throw new ConflictException($e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param BillboardEntity $billboard
     * @return JsonResponse
     */
    public function show(BillboardEntity $billboard) : JsonResponse
    {
        return $this->success(
            $this->billboardRepository->find($billboard->id)
        );
    }

    public function update(UpdateBillboardRequest $request, BillboardEntity $billboard)
    {

        $billboard->fill($request->all());

        if ($billboard->isClean()) {
            return $this->information(__('messages.nochange'));
        }

        return $this->success(
            $this->billboardRepository->save($billboard)
        );

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param BillboardEntity $billboard
     * @return JsonResponse
     */
    public function destroy(BillboardEntity $billboard) : JsonResponse
    {
        return $this->success(
            $this->billboardRepository->destroy($billboard)
        );
    }


    /**
     * Cancela una cartelera y todas las reservas asociadas.
     */
    public function cancel(Request $request)
    {
        $request->validate([
            'billboard_id' => 'required|integer',
        ]);

        try {
            $affectedCustomers = $this->billboardService->cancelBillboard($request->billboard_id);
            return response()->json([
                'message' => 'Cartelera cancelada con éxito',
                'affected_customers' => $affectedCustomers,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


}
