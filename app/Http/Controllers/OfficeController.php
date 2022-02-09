<?php

namespace App\Http\Controllers;

use App\Http\Requests\Office\StoreOfficeRequest;
use App\Http\Requests\Office\UpdateOfficeRequest;
use App\Services\OfficeService;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function store(StoreOfficeRequest $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $storeOffice = $officeServices->store($request);
//        dd($storeOffice);
        if (isSuccessResponse($storeOffice)) {
            $response = responseFormat('success', $storeOffice['data']);
        } else {
            $response = responseFormat('error', $storeOffice['data']);
        }
        return response()->json($response);
    }

    public function update(UpdateOfficeRequest $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $storeOffice = $officeServices->update($request);
        if (isSuccessResponse($storeOffice)) {
            $response = responseFormat('success', $storeOffice['data']);
        } else {
            $response = responseFormat('error', $storeOffice['data']);
        }
        return response()->json($response);
    }

    public function show(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $office_info = $officeServices->show($request);
        if (isSuccessResponse($office_info)) {
            $response = responseFormat('success', $office_info['data']);
        } else {
            $response = responseFormat('error', $office_info['data']);
        }
        return response()->json($response);
    }

    public function searchOffice(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $officeSearchList = $officeServices->searchOffice($request);
        if (isSuccessResponse($officeSearchList)) {
            $response = responseFormat('success', $officeSearchList['data']);
        } else {
            $response = responseFormat('error', $officeSearchList['data']);
        }
        return response()->json($response);
    }

    public function get_office_ministry_and_layer_wise(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $office_info = $officeServices->get_office_ministry_and_layer_wise($request);
        if (isSuccessResponse($office_info)) {
            $response = responseFormat('success', $office_info['data']);
        } else {
            $response = responseFormat('error', $office_info['data']);
        }
        return response()->json($response);
    }

    public function get_entity_office_ministry_wise(Request $request, OfficeService $officeServices)
    {
        $office_info = $officeServices->get_entity_office_ministry_wise($request);
        if (isSuccessResponse($office_info)) {
            $response = responseFormat('success', $office_info['data']);
        } else {
            $response = responseFormat('error', $office_info['data']);
        }
        return response()->json($response);

    }

    public function get_master_office_ministry_and_layer_wise(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $office_info = $officeServices->get_master_office_ministry_and_layer_wise($request);
        if (isSuccessResponse($office_info)) {
            $response = responseFormat('success', $office_info['data']);
        } else {
            $response = responseFormat('error', $office_info['data']);
        }
        return response()->json($response);
    }

    public function get_office_parent_wise(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $office_info = $officeServices->get_office_parent_wise($request);
        if (isSuccessResponse($office_info)) {
            $response = responseFormat('success', $office_info['data']);
        } else {
            $response = responseFormat('error', $office_info['data']);
        }
        return response()->json($response);
    }

    public function get_parent_wise_child_master_office(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $office_info = $officeServices->get_parent_wise_child_master_office($request);
        if (isSuccessResponse($office_info)) {
            $response = responseFormat('success', $office_info['data']);
        } else {
            $response = responseFormat('error', $office_info['data']);
        }
        return response()->json($response);
    }

    public function get_ministry_parent_wise_child_office(Request $request, OfficeService $officeServices)
    {

        $office_info = $officeServices->get_ministry_parent_wise_child_office($request);
        if (isSuccessResponse($office_info)) {
            $response = responseFormat('success', $office_info['data']);
        } else {
            $response = responseFormat('error', $office_info['data']);
        }
        return response()->json($response);
    }

    public function get_parent_wise_child_office(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $office_info = $officeServices->get_parent_wise_child_office($request);
        if (isSuccessResponse($office_info)) {
            $response = responseFormat('success', $office_info['data']);
        } else {
            $response = responseFormat('error', $office_info['data']);
        }
        return response()->json($response);
    }

    public function get_parent_with_child_office(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $offices = $officeServices->get_parent_with_child_office($request);
        if (isSuccessResponse($offices)) {
            $response = responseFormat('success', $offices['data']);
        } else {
            $response = responseFormat('error', $offices['data']);
        }
        return response()->json($response);
    }

    public function employeeDatatable(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $officeList = $officeServices->officeDatatable($request);
        if (isSuccessResponse($officeList)) {
            $response = responseFormat('success', $officeList['data']);
        } else {
            $response = responseFormat('error', $officeList['data']);
        }
        return response()->json($response);
    }

    public function parents(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $officeParentsList = $officeServices->parents($request);
        if (isSuccessResponse($officeParentsList)) {
            $response = responseFormat('success', $officeParentsList['data']);
        } else {
            $response = responseFormat('error', $officeParentsList['data']);
        }
        return response()->json($response);
    }

    public function ministryWiseEntity(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $officeEntityList = $officeServices->ministryWiseEntity($request);

        if (isSuccessResponse($officeEntityList)) {
            $response = responseFormat('success', $officeEntityList['data']);
        } else {
            $response = responseFormat('error', $officeEntityList['data']);
        }
        return response()->json($response);
    }

    public function ministryWiseOffice(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $officeList = $officeServices->ministryWiseOffice($request);

        if (isSuccessResponse($officeList)) {
            $response = responseFormat('success', $officeList['data']);
        } else {
            $response = responseFormat('error', $officeList['data']);
        }
        return response()->json($response);
    }

    public function delete(Request $request, OfficeService $officeServices): \Illuminate\Http\JsonResponse
    {
        $delete = $officeServices->delete($request);

        if (isSuccessResponse($delete)) {
            $response = responseFormat('success', $delete['data']);
        } else {
            $response = responseFormat('error', $delete['data']);
        }
        return response()->json($response);
    }

    public function getOfficesInfo(Request $request, OfficeService $officeService): \Illuminate\Http\JsonResponse
    {
        \Validator::make($request->all(), ['office_ids' => 'required'])->validate();

        $response = $officeService->getOfficesInfo($request);
        return response()->json($response);
    }

    public function getRelatedOffices(Request $request, OfficeService $officeService): \Illuminate\Http\JsonResponse
    {
        \Validator::make($request->all(), ['office_ids' => 'required', 'type' => 'required'])->validate();
        $response = $officeService->getRelatedOffices($request);
        return response()->json($response);
    }


}
