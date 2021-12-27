<?php

namespace App\Http\Controllers;

use App\Models\OfficeCategoryType;
use Illuminate\Http\Request;

class OfficeCategoryTypeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $categories = OfficeCategoryType::all();
            return response()->json(['status' => 'success', 'data' => $categories]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'data' => $exception->getMessage()]);
        }
    }

    public function show(Request $request)
    {
        \Validator::make($request->all(), ['type_id' => 'numeric']);
        try {
            if (!$request->type_id) {
                throw new \Exception('Category Type Is Not Provided');
            }
            $category = OfficeCategoryType::find($request->type_id);
            return response()->json(['status' => 'success', 'data' => $category]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'data' => $exception->getMessage()]);
        }
    }
}
