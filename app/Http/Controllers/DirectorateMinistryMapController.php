<?php

namespace App\Http\Controllers;
use App\Http\Requests\DirectorateMinistryMap\StoreDirectorateMinistryMapRequest;
use App\Http\Requests\DirectorateMinistryMap\UpdateDirectorateMinistryMapRequest;
use App\Services\DirectorateMinistryMapService;
use Illuminate\Http\Request;

class DirectorateMinistryMapController extends Controller
{
    public function store(StoreDirectorateMinistryMapRequest $request, DirectorateMinistryMapService $directorateMinistryMap): \Illuminate\Http\JsonResponse
    {
        $directorate_ministry_map = $directorateMinistryMap->store($request);
        if (isSuccessResponse($directorate_ministry_map)) {
            $response = responseFormat('success', $directorate_ministry_map['data']);
        } else {
            $response = responseFormat('error', $directorate_ministry_map['data']);
        }
        return response()->json($response);
    }

    public function update(UpdateDirectorateMinistryMapRequest $request, DirectorateMinistryMapService $directorateMinistryMap): \Illuminate\Http\JsonResponse
    {
        $directorate_ministry_map = $directorateMinistryMap->update($request);
        if (isSuccessResponse($directorate_ministry_map)) {
            $response = responseFormat('success', $directorate_ministry_map['data']);
        } else {
            $response = responseFormat('error', $directorate_ministry_map['data']);
        }
        return response()->json($response);
    }

    public function show(Request $request, OfficeUnitService $unit): \Illuminate\Http\JsonResponse
    {
        $unit_info = $unit->show($request->unit_id);
        if (isSuccessResponse($unit_info)) {
            $response = responseFormat('success', $unit_info['data']);
        } else {
            $response = responseFormat('error', $unit_info['data']);
        }
        return response()->json($response);
    }

    public function list(Request $request, OfficeUnitService $unit): \Illuminate\Http\JsonResponse
    {
        $unit_list = $unit->list($request);
        if (isSuccessResponse($unit_list)) {
            $response = responseFormat('success', $unit_list['data']);
        } else {
            $response = responseFormat('error', $unit_list['data']);
        }
        return response()->json($response);
    }

    public function getUnitCategoryList(Request $request, OfficeUnitService $unit): \Illuminate\Http\JsonResponse
    {
        $unit_category_list = $unit->getUnitCategoryList($request);
        if (isSuccessResponse($unit_category_list)) {
            $response = responseFormat('success', $unit_category_list['data']);
        } else {
            $response = responseFormat('error', $unit_category_list['data']);
        }
        return response()->json($response);
    }

    public function getOfficeUnitMinistryLayerAndOfficeWise(Request $request, OfficeUnitService $unit): \Illuminate\Http\JsonResponse
    {
        $unit_list = $unit->getOfficeUnitMinistryLayerAndOfficeWise($request);
        if (isSuccessResponse($unit_list)) {
            $response = responseFormat('success', $unit_list['data']);
        } else {
            $response = responseFormat('error', $unit_list['data']);
        }
        return response()->json($response);
    }

    public function getDirectorWiseMinistryList(Request $request, DirectorateMinistryMapService $directorateMinistryMap): \Illuminate\Http\JsonResponse
    {
        $listData = $directorateMinistryMap->getDirectorWiseMinistryList($request);
        if (isSuccessResponse($listData)) {
            $response = responseFormat('success', $listData['data']);
        } else {
            $response = responseFormat('error', $listData['data']);
        }
        return response()->json($response);
    }

}
