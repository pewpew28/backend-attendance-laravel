<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);
    Route::get('/me', [AuthController::class, 'me']);
    
    // Product routes (protected)
    // Route::apiResource('products', ProductController::class);

    Route::post('/attendance/generate-qr', [AttendanceController::class, 'generateQr']);
    Route::post('/attendance/validate-qr', [AttendanceController::class, 'validateQr']);

    Route::post('/attendance', [AttendanceController::class, 'store']);

    Route::get('/attendance/today', [AttendanceController::class, 'today']);
    Route::get('/attendance/history', [AttendanceController::class, 'history']);
    Route::get('/attendance/summary', [AttendanceController::class, 'summary']);
    Route::get('/attendance/status', [AttendanceController::class, 'status']);
    Route::get('/attendance/export', [AttendanceController::class, 'export']);

    Route::get('/attendance/locations', [AttendanceController::class, 'locations']);
});