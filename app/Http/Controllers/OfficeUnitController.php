<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateOfficeUnitRequest;
use App\Services\OfficeUnitService;


class OfficeUnitController extends Controller
{
    public function update(UpdateOfficeUnitRequest $request, OfficeUnitService $unit): \Illuminate\Http\JsonResponse
    {
        $update_unit = $unit->update($request);
        if (isSuccessResponse($update_unit)) {
            $response = responseFormat('success', $update_unit['data']);
        } else {
            $response = responseFormat('error', $update_unit['data']);
        }
        return response()->json($response);
    }

}
