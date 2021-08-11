<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/store-office', [App\Http\Controllers\OfficeController::class, 'storeOffice']);
Route::post('/get-office-info', [App\Http\Controllers\OfficeController::class, 'getOfficeInfo']);
Route::post('/store-employee', [App\Http\Controllers\EmployeeRecordController::class, 'storeEmployee']);
Route::post('/update-employee', [App\Http\Controllers\EmployeeRecordController::class, 'updateEmployee']);
