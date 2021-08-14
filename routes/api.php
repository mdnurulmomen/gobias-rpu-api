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
Route::post('/update-office-unit', [App\Http\Controllers\OfficeUnitController::class, 'update']);
Route::post('/get-office-unit-info', [App\Http\Controllers\OfficeUnitController::class, 'show']);
Route::post('/get-office-unit-list', [App\Http\Controllers\OfficeUnitController::class, 'list']);

//for employee
Route::post('/store-employee', [App\Http\Controllers\EmployeeRecordController::class, 'store']);
Route::post('/get-employee-info', [App\Http\Controllers\EmployeeRecordController::class, 'show']);
Route::post('/update-employee', [App\Http\Controllers\EmployeeRecordController::class, 'update']);

//for employee certificate
Route::post('/store-employee-certificate', [App\Http\Controllers\EmployeeCertificateController::class, 'store']);
Route::post('/get-employee-certificate-info', [App\Http\Controllers\EmployeeCertificateController::class, 'show']);
Route::post('/update-employee-certificate', [App\Http\Controllers\EmployeeCertificateController::class, 'update']);

//for employee training
Route::post('/store-employee-training', [App\Http\Controllers\EmployeeTrainingController::class, 'store']);
Route::post('/get-employee-training-info', [App\Http\Controllers\EmployeeTrainingController::class, 'show']);
Route::post('/update-employee-training', [App\Http\Controllers\EmployeeTrainingController::class, 'update']);

//for employee education
Route::post('/store-employee-education', [App\Http\Controllers\EmployeeEducationalController::class, 'store']);
Route::post('/get-employee-education-info', [App\Http\Controllers\EmployeeEducationalController::class, 'show']);
Route::post('/update-employee-education', [App\Http\Controllers\EmployeeEducationalController::class, 'update']);

//for lookup
Route::post('/store-lookup', [App\Http\Controllers\LookupController::class, 'store']);
Route::post('/get-lookup-info', [App\Http\Controllers\LookupController::class, 'show']);
Route::post('/update-lookup', [App\Http\Controllers\LookupController::class, 'update']);

//for lookup type
Route::post('/store-lookup-type', [App\Http\Controllers\LookupController::class, 'store']);
Route::post('/get-lookup-type-info', [App\Http\Controllers\LookupController::class, 'show']);
Route::post('/update-lookup-type', [App\Http\Controllers\LookupController::class, 'update']);

//responsible party
Route::post('/store-responsible-party', [App\Http\Controllers\ResponsiblePartyController::class, 'store']);
Route::post('/update-responsible-party', [App\Http\Controllers\ResponsiblePartyController::class, 'update']);
Route::post('/get-responsible-party-info', [App\Http\Controllers\ResponsiblePartyController::class, 'show']);
Route::post('/get-responsible-party-list', [App\Http\Controllers\ResponsiblePartyController::class, 'list']);
