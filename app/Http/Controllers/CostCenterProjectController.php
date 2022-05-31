<?php

namespace App\Http\Controllers;
use App\Services\CostCenterProjectService;
use Illuminate\Http\Request;

class CostCenterProjectController extends Controller
{
    public function store(Request $request, CostCenterProjectService $centerProjectService): \Illuminate\Http\JsonResponse
    {
        $store_cost_center_project_map = $centerProjectService->store($request);
        if (isSuccessResponse($store_cost_center_project_map)) {
            $response = responseFormat('success', $store_cost_center_project_map['data']);
        } else {
            $response = responseFormat('error', $store_cost_center_project_map['data']);
        }
        return response()->json($response);
    }

    public function list(Request $request, CostCenterProjectService $centerProjectService): \Illuminate\Http\JsonResponse
    {
        $list = $centerProjectService->list($request);
        if (isSuccessResponse($list)) {
            $response = responseFormat('success', $list['data']);
        } else {
            $response = responseFormat('error', $list['data']);
        }
        return response()->json($response);
    }

    public function get_project_map_entity_list(Request $request, CostCenterProjectService $centerProjectService): \Illuminate\Http\JsonResponse
    {
        $entity_list = $centerProjectService->get_project_map_entity_list($request);
        if (isSuccessResponse($entity_list)) {
            $response = responseFormat('success', $entity_list['data']);
        } else {
            $response = responseFormat('error', $entity_list['data']);
        }
        return response()->json($response);
    }

    public function get_project_map_cost_center_list(Request $request, CostCenterProjectService $centerProjectService): \Illuminate\Http\JsonResponse
    {
        $cost_center_list = $centerProjectService->get_project_map_cost_center_list($request);
        if (isSuccessResponse($cost_center_list)) {
            $response = responseFormat('success', $cost_center_list['data']);
        } else {
            $response = responseFormat('error', $cost_center_list['data']);
        }
        return response()->json($response);
    }

    public function get_project_map_nominated_cos_center_list(Request $request, CostCenterProjectService $centerProjectService): \Illuminate\Http\JsonResponse
    {
        $cost_center_list = $centerProjectService->get_project_map_nominated_cos_center_list($request);
        if (isSuccessResponse($cost_center_list)) {
            $response = responseFormat('success', $cost_center_list['data']);
        } else {
            $response = responseFormat('error', $cost_center_list['data']);
        }
        return response()->json($response);
    }
}
