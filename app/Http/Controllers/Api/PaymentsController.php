<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\PaymentsService;

class PaymentsController extends Controller
{
    public function __construct(
        private readonly PaymentsService $paymentsService
    )
    {}

    public function paymongoCreatePayment(Request $request)
    {
        $result = $this->paymentsService->createPayment(200, '', '');

        return response()->json($result, Response::HTTP_CREATED);
    }
}
