<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\EmployeeController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::apiResource('departments', DepartmentController::class)->names('api.departments');
    Route::apiResource('employees', EmployeeController::class)->names('api.employees');
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
