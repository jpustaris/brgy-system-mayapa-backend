<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\BlotterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserManagementController;
use App\Http\Controllers\Api\RoleManagementController;
use App\Http\Controllers\Api\ResidentController;
use App\Http\Controllers\Api\CertificatesController;
use App\Http\Controllers\Api\DashboardController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
  
    Route::put('brgy-users/{id}', [UserManagementController::class, 'updateByID']);
    Route::post('change-password', [UserManagementController::class, 'changePassword']);
    Route::get('users', [UserManagementController::class, 'index']);
    
    Route::get('get-dashboard-data', [DashboardController::class, 'fetchDashboardData']);
    

    Route::get('certificates/business-permits', [CertificatesController::class, 'fetchBRGYBusinessPermit']);
    Route::get('certificates/brgy-clearances', [CertificatesController::class, 'fetchBRGYClearance']);   
    Route::get('certificates/good-moral', [CertificatesController::class, 'fetchBRGYGoodMoral']);
    Route::get('certificates/indigencies', [CertificatesController::class, 'fetchBRGYIndigency']);
    Route::get('certificates/residencies', [CertificatesController::class, 'fetchBRGYResidency']);
    Route::get('get-barangay-officials', [CertificatesController::class, 'fetchBarangayOfficials']);
    
    Route::post('certificates/brgy-clearances', [CertificatesController::class, 'storeBRGYClearance']);
    Route::post('certificates/residencies', [CertificatesController::class, 'storeBRGYResidency']);
    Route::post('certificates/indigencies', [CertificatesController::class, 'storeBRGYIndigency']);
    
    
    Route::post('get-numbers', [CertificatesController::class, 'storeBRGYIndigency']);
    
    
    // Route::get('get-users', [UserManagementController::class, 'fetchUsers']);

    // Profiling OR Residents
        Route::get('get-hws', [ResidentController::class, 'fetchHWs']);
        Route::get('get-seniors', [ResidentController::class, 'fetchSeniors']);
        Route::get('get-pwds', [ResidentController::class, 'fetchPWDs']);
        Route::apiResource('residents', ResidentController::class);

    // Role Management
        Route::get('settings/roles', [RoleManagementController::class, 'index']);
        Route::put('settings/roles/{id}', [RoleManagementController::class, 'updateRole']);
        Route::post('settings/roles', [RoleManagementController::class, 'storeRole']);
        Route::delete('settings/roles/{id}', [RoleManagementController::class, 'deleteRole']);
    
    // Blotters
        Route::put('blotters/{id}', [BlotterController::class, 'updateByID']);
        Route::get('blotters-by-user', [BlotterController::class, 'blottersByUser']);
        Route::apiResource('blotters', BlotterController::class);
        
    
   
    // Route::apiResource('users', UserManagementController::class);

    
});

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('get-numbers', [ResidentController::class, 'getNumbers']);
    
