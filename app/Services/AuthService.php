<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\User;
use App\Models\UserSession;
use App\Models\UserOtp;
use App\Services\Admin\RolesService;
use App\Services\Patients\PatientInformationsService;

class AuthService {
    public function __construct(
        private readonly User $user,
        private readonly UserSession $userSession,
        private readonly UserOtp $userOtp,
        private readonly RolesService $rolesService,
        private readonly PatientInformationsService $patientInformationsService
    )
    {}

    private function _checkEmailAvailability($email)
    {
        $checkEmail = $this->user->query()->where('email', $email)->first();

        if ($checkEmail)
        {
            return true;
        }

        return false;
    }

    private function _createSessionLog($user)
    {
        $sessionId = Str::random(10);

        return $this->userSession->query()->create([
            'session_id'    => $sessionId,
            'user_id'       => $user->id,
            'user_name'     => $user->name,
            'user_email'    => $user->email,
            'signin_at'      => now()
        ]);
    }

    private function _endSessionLog($sessionId)
    {
        return $this->userSession
                ->where('session_id', $sessionId)
                ->update([
                    'signoutAt' => now()
                ]);
    }

    public function patientSignup($data)
    {
        if ($this->_checkEmailAvailability($data->account_data['email']))
        {
            throw new HttpException(400, 'EMAIL_ALREADY_USED');
        }

        DB::beginTransaction();

        try
        {
            $patientRole = $this->rolesService->findByName('patient');
            $user = User::query()->create(
                array_merge(
                    $data->account_data,
                    [
                        'password'      => bcrypt($data->account_data['password']),
                        'user_role_id'  => $patientRole->id
                    ]
                )
            );
            $patient_information = $this->patientInformationsService->create(
                array_merge(
                    [
                        'user_id' => $user->id,

                    ],
                    $data->patient_information
                )
            );

            DB::commit();

            return [
                'user'                  => $user,
                'patient_information'   => $patient_information
            ];
        } catch (\Exception $error)
        {
            DB::rollBack();
        }


    }

    public function authenticate($credentials)
    {
        if (Auth::attempt($credentials))
        {
            /**
             * @var App\Models\User $user
             */
            $user = Auth::user();
            $user->load('user_role');
            $token = $user->createToken(now()->timestamp)->plainTextToken;
            $session = $this->_createSessionLog($user);

            return (object) array(
                'token'     => $token,
                'user'      => $user,
                'session'   => $session->session_id
            );
        }

        throw new HttpException(401, 'USER_NOT_FOUND');
    }

    public function unauthenticate($user, $sessionId)
    {
        $user->currentAccessToken()->delete();
        $session = $this->_endSessionLog($sessionId);

        return $session;
    }

    public function createOtp($payload)
    {
        $user = $this->user->query()->where('email', $payload['email']);

        if (!$user) {
            throw new HttpException(404, 'USER_NOT_FOUND');
        }

        $code = random_int(100000, 999999);
        $expiresAt = Carbon::now()->addHours(2);

        // TODO: Send OTP via mail

        return $this->userOtp->query()->create([
            'code' => $code,
            'expires_at' => $expiresAt
        ]);
    }

    public function verifyOtp($payload)
    {
        //
    }
}
