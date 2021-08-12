<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//office layer
Route::post('/store-office-layer', [App\Http\Controllers\OfficeLayerController::class, 'store']);
Route::post('/update-office-layer', [App\Http\Controllers\OfficeLayerController::class, 'update']);
Route::post('/get-office-layer-info', [App\Http\Controllers\OfficeLayerController::class, 'show']);

//for office
Route::post('/store-office', [App\Http\Controllers\OfficeController::class, 'store']);
Route::post('/update-office', [App\Http\Controllers\OfficeController::class, 'update']);
Route::post('/get-office-info', [App\Http\Controllers\OfficeController::class, 'show']);

//office unit
Route::post('/update-office-unit', [App\Http\Controllers\OfficeUnitController::class, 'update']);

//for employee
Route::post('/store-employee', [App\Http\Controllers\EmployeeRecordController::class, 'store']);
Route::post('/update-employee', [App\Http\Controllers\EmployeeRecordController::class, 'update']);
