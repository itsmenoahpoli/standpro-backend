<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SystemController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentsController;
use App\Http\Controllers\Api\Admin\AccountsController;
use App\Http\Controllers\Api\Admin\RolesController;
use App\Http\Controllers\Api\Admin\Patients\PatientAppointmentsController;
use App\Http\Controllers\Api\Admin\Patients\PatientInformationsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->middleware('verify.api-key')->group(function () {
    Route::get('healthcheck', [SystemController::class, 'healthcheck'])->name('api.healthcheck');


    /**
     * Auth Routes
     */
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login'])->name('auth.login');
        Route::post('request-otp', [AuthController::class, 'requestOtp'])->name('auth.request-otp');
        Route::post('patient-signup', [AuthController::class, 'patientSignup'])->name('auth.patient-signup');

        Route::middleware('auth:sanctum')->group(function () {
            Route::get('me', [AuthController::class, 'me'])->name('auth.me');
            Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
        });
    });

    /**
     * Payment Routes
     */
    Route::prefix('payments')->group(function() {
        Route::post('paymongo/pay', [PaymentsController::class, 'paymongoCreatePayment'])->name('payments.paymongo-pay');
    });

    /**
     * Admin Routes
     */
    Route::prefix('admin')->middleware(['auth:sanctum', 'role.admin'])->group(function () {
        Route::apiResources([
            'accounts' => AccountsController::class,
            'roles' => RolesController::class,
        ]);


        /**
         * Assign role to account
         */
        Route::patch('accounts/{accountId}role/assign/{userRoleId}', [AccountsController::class, 'assignRoleToAccount']);
        Route::patch('accounts/{accountId}role/unassign', [AccountsController::class, 'unassignRoleToAccount']);

        /**
         * Patients data
         */
        Route::apiResources([
            'patient-appointments' => PatientAppointmentsController::class,
            'patient-informations' => PatientInformationsController::class
        ]);
    });
});
