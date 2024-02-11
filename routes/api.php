<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/device_list', [\App\Http\Controllers\API\AttendenceController::class, 'device_list']);
Route::post('/upload_log', [\App\Http\Controllers\API\AttendenceController::class, 'upload_log']);
Route::post('/uploadEmpList', [\App\Http\Controllers\API\AttendenceController::class, 'uploadEmpList']);
Route::post('/syncid', [\App\Http\Controllers\API\AttendenceController::class, 'syncid']);
Route::post('/UpdateStatus', [\App\Http\Controllers\API\AttendenceController::class, 'UpdateStatus']);
