<?php

namespace App\Http\Controllers;
use App\Repository\Eloquent\UnitRepository;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateOfficeUnitRequest;
use App\Services\OfficeUnitServices;


class OfficeUnitController extends Controller
{
    public function updateUnit(UpdateOfficeUnitRequest $request, OfficeUnitServices $unit): \Illuminate\Http\JsonResponse
    {
        $update_unit = $unit->updateUnit($request);
        if (isSuccessResponse($update_unit)) {
            $response = responseFormat('success', $update_unit['data']);
        } else {
            $response = responseFormat('error', $update_unit['data']);
        }
        return response()->json($response);
    }

    public function getOfficeInfo(Request $request,OfficeRepository $officeRepository): \Illuminate\Http\JsonResponse
    {
        $office_info = $officeRepository->get_office_info($request->office_id);
        if (isSuccessResponse($office_info)) {
            $response = responseFormat('success', $office_info['data']);
        } else {
            $response = responseFormat('error', $office_info['data']);
        }
        return response()->json($response);
    }
}
