<?php

namespace App\Http\Controllers;

use App\Services\CadreService;
use Illuminate\Http\Request;

class CadreController extends Controller
{
    public function list(Request $request, CadreService $cadreService): \Illuminate\Http\JsonResponse
    {
        $cadreList = $cadreService->list($request);
        if (isSuccessResponse($cadreList)) {
            $response = responseFormat('success', $cadreList['data']);
        } else {
            $response = responseFormat('error', $cadreList['data']);
        }
        return response()->json($response);
    }
}
