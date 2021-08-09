<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/store-office', [App\Http\Controllers\OfficeController::class, 'storeOffice']);
