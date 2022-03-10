<?php

use Illuminate\Support\Facades\Route;

Route::post('login-in-rpu-amms', [App\Http\Controllers\LoginController::class, 'loginInRpuAmms']);

Route::post('client-login', [App\Http\Controllers\LoginController::class, 'clientLogin']);

//user
Route::post('/get-user-list', [App\Http\Controllers\UserController::class, 'list']);
//office ministry
Route::post('/get-office-ministry-list', [App\Http\Controllers\OfficeMinistryController::class, 'list']);

//office layer
Route::post('/store-office-layer', [App\Http\Controllers\OfficeLayerController::class, 'store']);
Route::post('/update-office-layer', [App\Http\Controllers\OfficeLayerController::class, 'update']);
Route::post('/get-office-layer-info', [App\Http\Controllers\OfficeLayerController::class, 'show']);
Route::post('/get-office-layer-list', [App\Http\Controllers\OfficeLayerController::class, 'list']);
Route::post('/get-office-layer-ministry-wise', [App\Http\Controllers\OfficeLayerController::class, 'getOfficeLayerMinistryWise']);
Route::post('/get-office-layer-tree-ministry-wise', [App\Http\Controllers\OfficeLayerController::class, 'getOfficeLayerTreeMinistryWise']);
Route::post('/get-office-layer-parent-ministry-wise', [App\Http\Controllers\OfficeLayerController::class, 'getOfficeLayerParentAndMinistryWise']);

//office custom layer
Route::post('/list-office-custom-layer', [App\Http\Controllers\OfficeCustomLayerController::class, 'list']);

//for office
Route::post('/store-office', [App\Http\Controllers\OfficeController::class, 'store']);
Route::post('/update-office', [App\Http\Controllers\OfficeController::class, 'update']);
Route::post('/get-office-info', [App\Http\Controllers\OfficeController::class, 'show']);
Route::post('/get-offices-info', [App\Http\Controllers\OfficeController::class, 'getOfficesInfo']);
Route::post('/related-offices', [\App\Http\Controllers\OfficeController::class, 'getRelatedOffices']);
Route::post('/delete-office', [App\Http\Controllers\OfficeController::class, 'delete']);
Route::post('/get-office-ministry-and-layer-wise', [App\Http\Controllers\OfficeController::class, 'get_office_ministry_and_layer_wise']);
Route::post('/get-entity-office-ministry-wise', [App\Http\Controllers\OfficeController::class, 'get_entity_office_ministry_wise']);
Route::post('/get-office-parent-wise', [App\Http\Controllers\OfficeController::class, 'get_office_parent_wise']);
Route::post('/get-parent-wise-child-office', [App\Http\Controllers\OfficeController::class, 'get_parent_wise_child_office']);
Route::post('/get-parent-with-child-office', [App\Http\Controllers\OfficeController::class, 'get_parent_with_child_office']);
Route::post('/get-ministry-parent-wise-child-office', [App\Http\Controllers\OfficeController::class, 'get_ministry_parent_wise_child_office']);
Route::post('/search-office', [App\Http\Controllers\OfficeController::class, 'searchOffice']);
Route::post('/get-office-list-datatable', [App\Http\Controllers\OfficeController::class, 'employeeDatatable']);
Route::post('/get-office-other-info', [App\Http\Controllers\OfficeOtherInfoController::class, 'show']);
Route::post('/store-office-other-info', [App\Http\Controllers\OfficeOtherInfoController::class, 'store']);
Route::post('/get-office-other-info-list', [App\Http\Controllers\OfficeOtherInfoController::class, 'getOfficeOtherInfoList']);
Route::post('/office-parents', [App\Http\Controllers\OfficeController::class, 'parents']);
Route::post('/office-ministry-wise-entity', [App\Http\Controllers\OfficeController::class, 'ministryWiseEntity']);
Route::post('/ministry-wise-office', [App\Http\Controllers\OfficeController::class, 'ministryWiseOffice']);

Route::post('/get-master-office-ministry-and-layer-wise', [App\Http\Controllers\OfficeController::class, 'get_master_office_ministry_and_layer_wise']);
Route::post('/get-parent-wise-child-master-office', [App\Http\Controllers\OfficeController::class, 'get_parent_wise_child_master_office']);
//office unit
Route::post('/store-office-unit', [App\Http\Controllers\OfficeUnitController::class, 'store']);
Route::post('/update-office-unit', [App\Http\Controllers\OfficeUnitController::class, 'update']);
Route::post('/get-office-unit-info', [App\Http\Controllers\OfficeUnitController::class, 'show']);
Route::post('/get-office-unit-list', [App\Http\Controllers\OfficeUnitController::class, 'list']);
Route::post('/get-office-unit-category-list', [App\Http\Controllers\OfficeUnitController::class, 'getUnitCategoryList']);
Route::post('/get-office-unit-ministry-layer-and-office-wise', [App\Http\Controllers\OfficeUnitController::class, 'getOfficeUnitMinistryLayerAndOfficeWise']);

//cost center
Route::post('/store-cost-center', [App\Http\Controllers\CostCenterController::class, 'store']);
Route::post('/cost-center-list', [App\Http\Controllers\CostCenterController::class, 'list']);
//directorate ministry map
Route::post('/store-directorate-ministry-map', [App\Http\Controllers\DirectorateMinistryMapController::class, 'store']);
Route::post('/update-directorate-ministry-map', [App\Http\Controllers\DirectorateMinistryMapController::class, 'update']);
Route::post('/get-directorate-ministry-info', [App\Http\Controllers\DirectorateMinistryMapController::class, 'show']);
Route::post('/get-directorate-ministry-all', [App\Http\Controllers\DirectorateMinistryMapController::class, 'list']);
Route::post('/get-directorate-wise-ministry-list', [App\Http\Controllers\DirectorateMinistryMapController::class, 'getDirectorWiseMinistryList']);

//for employee
Route::post('/store-employee', [App\Http\Controllers\EmployeeRecordController::class, 'store']);
Route::post('/get-employee-info', [App\Http\Controllers\EmployeeRecordController::class, 'show']);
Route::post('/update-employee', [App\Http\Controllers\EmployeeRecordController::class, 'update']);
Route::post('/profile-employee', [App\Http\Controllers\EmployeeRecordController::class, 'profile']);
Route::post('/search-employee', [App\Http\Controllers\EmployeeRecordController::class, 'search']);
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

//for cadre
Route::post('/list-cadre', [App\Http\Controllers\CadreController::class, 'list']);

//for batch
Route::post('/list-batch', [App\Http\Controllers\BatchController::class, 'list']);

//for language
Route::post('/list-language', [App\Http\Controllers\LanguageController::class, 'list']);

//for lookup
Route::post('/store-lookup', [App\Http\Controllers\LookupController::class, 'store']);
Route::post('/get-lookup-info', [App\Http\Controllers\LookupController::class, 'show']);
Route::post('/update-lookup', [App\Http\Controllers\LookupController::class, 'update']);
Route::post('/get-lookup-type-wise', [App\Http\Controllers\LookupController::class, 'getLookupTypeWise']);

//for lookup type
Route::post('/store-lookup-type', [App\Http\Controllers\LookupController::class, 'store']);
Route::post('/get-lookup-type-info', [App\Http\Controllers\LookupController::class, 'show']);
Route::post('/update-lookup-type', [App\Http\Controllers\LookupController::class, 'update']);


//Mis Dashboard
Route::post('/get-rpu-list-mis', [App\Http\Controllers\MisAndDashboardController::class, 'rpuList']);
//responsible party
Route::post('/store-responsible-party', [App\Http\Controllers\ResponsiblePartyController::class, 'store']);
Route::post('/update-responsible-party', [App\Http\Controllers\ResponsiblePartyController::class, 'update']);
Route::post('/get-responsible-party-info', [App\Http\Controllers\ResponsiblePartyController::class, 'show']);
Route::post('/get-responsible-party-list', [App\Http\Controllers\ResponsiblePartyController::class, 'list']);
Route::post('/get-cost-center-office-list', [App\Http\Controllers\ResponsiblePartyController::class, 'getCostCenterOffice']);
Route::post('/get-cost-center-unit-list', [App\Http\Controllers\ResponsiblePartyController::class, 'getCostCenterunit']);

//audit query
Route::post('/send-audit-query', [App\Http\Controllers\AuditQueryController::class, 'store']);
Route::post('/receive-query-from-rpu', [App\Http\Controllers\AuditQueryController::class, 'receiveQuery']);
Route::post('/remove-query-from-rpu', [App\Http\Controllers\AuditQueryController::class, 'removeQuery']);

//audit memo
Route::post('/send-audit-memo', [App\Http\Controllers\AcMemoController::class, 'store']);
Route::post('/update-audit-memo', [App\Http\Controllers\AcMemoController::class, 'update']);

//for language
Route::post('/list-language', [App\Http\Controllers\LanguageController::class, 'list']);

//for country
Route::post('/get-geo-country-list', [App\Http\Controllers\GeoCountryController::class, 'list']);

//for division
Route::post('/get-geo-division-list', [App\Http\Controllers\GeoDivisionController::class, 'list']);

//for district
Route::post('/get-geo-district-list', [App\Http\Controllers\GeoDistrictController::class, 'list']);
Route::post('/get-district-division-wise', [App\Http\Controllers\GeoDistrictController::class, 'getDistrictDivisionWise']);

//for upazila
Route::post('/get-upozila-district-wise', [App\Http\Controllers\GeoUpozilaController::class, 'getUpozilaDistrictWise']);

//For Office Category Type
Route::post('/get-all-office-category-types', [\App\Http\Controllers\OfficeCategoryTypeController::class, 'index']);
Route::post('/office-category', [\App\Http\Controllers\OfficeCategoryTypeController::class, 'show']);

//Air
Route::post('/send-air-to-rpu', [\App\Http\Controllers\RpuAirReportController::class, 'store']);
Route::post('/broad-sheet-apotti-update', [\App\Http\Controllers\RpuAirReportController::class, 'updateApottiItem']);
Route::post('/broad-sheet-reply-from-directorate', [\App\Http\Controllers\RpuAirReportController::class, 'broadSheetReplyFromDirectorate']);
