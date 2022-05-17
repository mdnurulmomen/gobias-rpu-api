<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request, ProjectService $projectService): \Illuminate\Http\JsonResponse
    {
        $store = $projectService->store($request);
        if (isSuccessResponse($store)) {
            $response = responseFormat('success', $store['data']);
        } else {
            $response = responseFormat('error', $store['data']);
        }

        return response()->json($response);
    }

    public function list(Request $request, ProjectService $projectService): \Illuminate\Http\JsonResponse
    {
        $projectlist = $projectService->list($request);
        if (isSuccessResponse($projectlist)) {
            $response = responseFormat('success', $projectlist['data']);
        } else {
            $response = responseFormat('error', $projectlist['data']);
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
//
        if (isSuccessResponse($projectdata)) {
            $response = responseFormat('success', $projectdata['data']);
        } else {
            $response = responseFormat('error', $projectdata['data']);
        }
        return response()->json($response);
    }
}
