<?php

namespace App\Http\Controllers;

use App\Services\AuditFunctionService;
use Illuminate\Http\Request;

class FunctionController extends Controller
{
    public function store(Request $request, AuditFunctionService $functionService): \Illuminate\Http\JsonResponse
    {
        $store = $functionService->store($request);
        if (isSuccessResponse($store)) {
            $response = responseFormat('success', $store['data']);
        } else {
            $response = responseFormat('error', $store['data']);
        }

        return response()->json($response);
    }

    public function list(Request $request, AuditFunctionService $functionService): \Illuminate\Http\JsonResponse
    {
        $functionlist = $functionService->list($request);

        if (isSuccessResponse($functionlist)) {
            $response = responseFormat('success', $functionlist['data']);
        } else {
            $response = responseFormat('error', $functionlist['data']);
        }

        return response()->json($response);
    }

    public function show(Request $request, ProjectService $projectService): \Illuminate\Http\JsonResponse
    {
        $project = $projectService->show($request);
        if (isSuccessResponse($project)) {
            $response = responseFormat('success', $project['data']);
        } else {
            $response = responseFormat('error', $project['data']);
        }

        return response()->json($response);
    }

    public function update(Request $request, ProjectService $projectService): \Illuminate\Http\JsonResponse
    {
        $projectdata = $projectService->update($request);

        if (isSuccessResponse($projectdata)) {
            $response = responseFormat('success', $projectdata['data']);
        } else {
            $response = responseFormat('error', $projectdata['data']);
        }

        return response()->json($response);
    }
}
