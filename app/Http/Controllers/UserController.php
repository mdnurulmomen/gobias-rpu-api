<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request, UserService $userService): \Illuminate\Http\JsonResponse
    {
        $userList = $userService->list($request);
        if (isSuccessResponse($userList)) {
            $response = responseFormat('success', $userList['data']);
        } else {
            $response = responseFormat('error', $userList['data']);
        }
        return response()->json($response);
    }
}
