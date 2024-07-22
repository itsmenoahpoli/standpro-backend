<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class SystemController extends Controller
{
    public function healthcheck() : JsonResponse
    {
        return response()->json(['status' => 'online'], Response::HTTP_OK);
    }
}
