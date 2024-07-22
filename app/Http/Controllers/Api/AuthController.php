<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\AuthService;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\GetOtpRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use App\Http\Requests\Auth\PatientSignupRequest;




class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    )
    {}

    public function patientSignup(PatientSignupRequest $request) : JsonResponse
    {
        $result = $this->authService->patientSignup((object) $request->validated());

        return response()->json($result, Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request) : JsonResponse
    {
        $result = $this->authService->authenticate($request->validated());

        return response()->json($result, Response::HTTP_OK);
    }

    public function logout(Request $request, $sessionId): JsonResponse
    {
        $result = $this->authService->unauthenticate($request->user(), $sessionId);

        return response()->json($result, Response::HTTP_OK);
    }

    public function requestOtp(GetOtpRequest $request) : JsonResponse
    {
        $result = $this->authService->createOtp($request->validated());

        return response()->json($result, Response::HTTP_OK);
    }

    public function verifytOtp(VerifyOtpRequest $request) : JsonResponse
    {
        $result = $this->authService->verifyOtp($request->validated());

        return response()->json($result, Response::HTTP_OK);
    }

    public function me(Request $request) : JsonResponse
    {
        $result = $request->user();

        return response()->json($result, Response::HTTP_OK);

    }
}
