<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//office ministry
Route::post('/get-office-ministry-list', [App\Http\Controllers\OfficeMinistryController::class, 'list']);

//office layer
Route::post('/store-office-layer', [App\Http\Controllers\OfficeLayerController::class, 'store']);
Route::post('/update-office-layer', [App\Http\Controllers\OfficeLayerController::class, 'update']);
Route::post('/get-office-layer-info', [App\Http\Controllers\OfficeLayerController::class, 'show']);
Route::post('/get-office-layer-ministry-wise', [App\Http\Controllers\OfficeLayerController::class, 'getOfficeLayerMinistryWise']);
Route::post('/get-office-layer-tree-ministry-wise', [App\Http\Controllers\OfficeLayerController::class, 'getOfficeLayerTreeMinistryWise']);

//office custom layer
Route::post('/list-office-custom-layer', [App\Http\Controllers\OfficeCustomLayerController::class, 'list']);

//for office
Route::post('/store-office', [App\Http\Controllers\OfficeController::class, 'store']);
Route::post('/update-office', [App\Http\Controllers\OfficeController::class, 'update']);
Route::post('/get-office-info', [App\Http\Controllers\OfficeController::class, 'show']);
Route::post('/get-office-ministry-and-layer-wise', [App\Http\Controllers\OfficeController::class, 'get_office_ministry_and_layer_wise']);
Route::post('/search-office', [App\Http\Controllers\OfficeController::class, 'searchOffice']);

//office unit
Route::post('/store-office-unit', [App\Http\Controllers\OfficeUnitController::class, 'store']);
Route::post('/update-office-unit', [App\Http\Controllers\OfficeUnitController::class, 'update']);
Route::post('/get-office-unit-info', [App\Http\Controllers\OfficeUnitController::class, 'show']);
Route::post('/get-office-unit-list', [App\Http\Controllers\OfficeUnitController::class, 'list']);
Route::post('/get-office-unit-category-list', [App\Http\Controllers\OfficeUnitController::class, 'getUnitCategoryList']);
Route::post('/get-office-unit-ministry-layer-and-office-wise', [App\Http\Controllers\OfficeUnitController::class, 'getOfficeUnitMinistryLayerAndOfficeWise']);

//for employee
Route::post('/store-employee', [App\Http\Controllers\EmployeeRecordController::class, 'store']);
Route::post('/get-employee-info', [App\Http\Controllers\EmployeeRecordController::class, 'show']);
Route::post('/update-employee', [App\Http\Controllers\EmployeeRecordController::class, 'update']);
Route::post('/profile-employee', [App\Http\Controllers\EmployeeRecordController::class, 'profile']);
Route::post('/get-employee-list-datatable', [App\Http\Controllers\EmployeeRecordController::class, 'employeeDatatable']);

//for employee certificate
Route::post('/store-employee-certificate', [App\Http\Controllers\EmployeeCertificateController::class, 'store']);
Route::post('/get-employee-certificate-info', [App\Http\Controllers\EmployeeCertificateController::class, 'show']);
Route::post('/update-employee-certificate', [App\Http\Controllers\EmployeeCertificateController::class, 'update']);
Route::post('/get-single-employee-certificate-list', [App\Http\Controllers\EmployeeCertificateController::class, 'getSingleEmployeeCertificateList']);
Route::post('/delete-employee-certificate', [App\Http\Controllers\EmployeeCertificateController::class, 'delete']);

//for employee training
Route::post('/store-employee-training', [App\Http\Controllers\EmployeeTrainingController::class, 'store']);
Route::post('/get-employee-training-info', [App\Http\Controllers\EmployeeTrainingController::class, 'show']);
Route::post('/update-employee-training', [App\Http\Controllers\EmployeeTrainingController::class, 'update']);
Route::post('/get-single-employee-training-list', [App\Http\Controllers\EmployeeTrainingController::class, 'getSingleEmployeeTrainingList']);
Route::post('/delete-employee-training', [App\Http\Controllers\EmployeeTrainingController::class, 'delete']);

//for employee education
Route::post('/store-employee-education', [App\Http\Controllers\EmployeeEducationalController::class, 'store']);
Route::post('/get-employee-education-info', [App\Http\Controllers\EmployeeEducationalController::class, 'show']);
Route::post('/update-employee-education', [App\Http\Controllers\EmployeeEducationalController::class, 'update']);
Route::post('/get-single-employee-education-list', [App\Http\Controllers\EmployeeEducationalController::class, 'getSingleEmployeeEducationList']);
Route::post('/delete-employee-education', [App\Http\Controllers\EmployeeEducationalController::class, 'delete']);

//for lookup
Route::post('/store-lookup', [App\Http\Controllers\LookupController::class, 'store']);
Route::post('/get-lookup-info', [App\Http\Controllers\LookupController::class, 'show']);
Route::post('/update-lookup', [App\Http\Controllers\LookupController::class, 'update']);
Route::post('/get-lookup-type-wise', [App\Http\Controllers\LookupController::class, 'getLookupTypeWise']);

//for lookup type
Route::post('/store-lookup-type', [App\Http\Controllers\LookupController::class, 'store']);
Route::post('/get-lookup-type-info', [App\Http\Controllers\LookupController::class, 'show']);
Route::post('/update-lookup-type', [App\Http\Controllers\LookupController::class, 'update']);

//responsible party
Route::post('/store-responsible-party', [App\Http\Controllers\ResponsiblePartyController::class, 'store']);
Route::post('/update-responsible-party', [App\Http\Controllers\ResponsiblePartyController::class, 'update']);
Route::post('/get-responsible-party-info', [App\Http\Controllers\ResponsiblePartyController::class, 'show']);
Route::post('/get-responsible-party-list', [App\Http\Controllers\ResponsiblePartyController::class, 'list']);

//for division
Route::post('/get-geo-division-list', [App\Http\Controllers\GeoDivisionController::class, 'list']);

//for district
Route::post('/get-district-division-wise', [App\Http\Controllers\GeoDistrictController::class, 'getDistrictDivisionWise']);

//for upazila
Route::post('/get-upozila-district-wise', [App\Http\Controllers\GeoUpozilaController::class, 'getUpozilaDistrictWise']);
