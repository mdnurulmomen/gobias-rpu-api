<?php

namespace App\Http\Controllers;

use App\Services\LanguageService;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function list(Request $request, LanguageService $languageService): \Illuminate\Http\JsonResponse
    {
        $languageList = $languageService->list($request);
        if (isSuccessResponse($languageList)) {
            $response = responseFormat('success', $languageList['data']);
        } else {
            $response = responseFormat('error', $languageList['data']);
        }
        return response()->json($response);
    }
}
