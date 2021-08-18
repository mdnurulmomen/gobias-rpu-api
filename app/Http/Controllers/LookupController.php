<?php

namespace App\Http\Controllers;

use App\Services\LookupService;
use Illuminate\Http\Request;

class LookupController extends Controller
{
    public function store()
    {

    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function getLookupTypeWise(Request $request, LookupService $lookupService): \Illuminate\Http\JsonResponse
    {
        $lookupTypes = $lookupService->getLookupTypeWise($request);
        if (isSuccessResponse($lookupTypes)) {
            $response = responseFormat('success', $lookupTypes['data']);
        } else {
            $response = responseFormat('error', $lookupTypes['data']);
        }
        return response()->json($response);
    }
}
