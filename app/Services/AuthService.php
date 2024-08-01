<?php

namespace App\Services;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserOtp;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthService
{
    public function __construct(
        private readonly User $user,
        private readonly UserOtp $userOtp
    )
    {}

    public function authenticate($credentials)
    {
        if (Auth::attempt($credentials))
        {
            /**
             * @var App\Models\User $user
             */
            $user = Auth::user()->load('user_role');
            $token = $user->createToken(
                'authToken', ['*'], now()->addHours(24)
            )->plainTextToken;

            return (object) array(
                'token'     => $token,
                'user'      => $user
            );
        }

        throw new HttpException(401, 'USER_NOT_FOUND');
    }

    public function unauthenticate($user)
    {
        $user->currentAccessToken()->delete();

        return null;
    }

    public function createOTP($email)
    {
        $user = $this->user->query()->find('email', $email)->first();

        if (!$user)
        {
            throw new NotFoundHttpException('USER_NOT_FOUND');
        }

        $this->userOtp->query()->create([
            'user_id'   => $user->id,
            'code'      => rand(1000, 9999),
            'is_used'   => false
        ]);

        return true;
    }

    public function verifyOTP($code)
    {
        $otp = $this->userOtp->query()->find('code', $code)->first();

        if ($otp->is_used)
        {
            throw new BadRequestHttpException('CODE_IS_INVALID');
        }

        return true;
    }
}
