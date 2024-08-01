<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SystemController;
use App\Http\Controllers\Api\AuthController;

/**
 * Admin Modules
 */
use App\Http\Controllers\Api\Admin\AccountsController;
use App\Http\Controllers\Api\Admin\RolesController;

Route::prefix('v1')->group(function() {
    Route::get('healthcheck', [SystemController::class, 'healthcheck'])->name('api.healthcheck');
    Route::post('testmail', [SystemController::class, 'testmail'])->name('api.testmail');

   /**
     * Auth Routes
     */
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login'])->name('auth.login');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
        });
    });

    Route::prefix('admin')->group(function () {
        /**
         * Auth management
         */
        Route::apiResources([
            'accounts'      => AccountsController::class,
            'roles'         => RolesController::class,
        ]);


        /**
         * Assign role to account
         */
        Route::patch('accounts/{accountId}role/assign/{userRoleId}', [AccountsController::class, 'assignRoleToAccount']);
        Route::patch('accounts/{accountId}role/unassign', [AccountsController::class, 'unassignRoleToAccount']);

        /**
         * Data Management
         */
    });
});
