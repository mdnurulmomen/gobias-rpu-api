<?php

namespace App\Http\Controllers;

use App\Models\AuditArea;
use Illuminate\Http\Request;

class AuditAreaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->sector_id && $request->sector_type) {

            try {

                $list = AuditArea::where('sector_id', $request->sector_id)
                ->where('sector_type', $request->sector_type)
                ->with(['sector', 'childs', 'parent'])
                ->get();

                $response = responseFormat('success', $list);

            } catch (\Exception $exception) {

                $response = responseFormat('error', $exception->getMessage());

            }


        } else {

            try {

                $list =  AuditArea::with(['sector', 'childs', 'parent'])->get();

                $response = responseFormat('success', $list);

            } catch (\Exception $exception) {
                $response = responseFormat('error', $exception->getMessage());
            }

        }

        return response()->json($response);
    }

    public function store(Request $request)
    {
        try {

            $xRiskFactorImpact = new AuditArea();
            $xRiskFactorImpact->name_bn = strtolower($request->name_bn);
            $xRiskFactorImpact->name_en = strtolower($request->name_en);
            $xRiskFactorImpact->parent_id = $request->parent_id;
            $xRiskFactorImpact->sector_id = $request->sector_id;
            $xRiskFactorImpact->sector_type = $request->sector_type;
            $xRiskFactorImpact->created_by = $request->created_by;
            $xRiskFactorImpact->updated_by = $request->updated_by;
            $xRiskFactorImpact->save();

            $response = responseFormat('success', 'Save Successfully');

        } catch (\Exception $exception) {
            $response = responseFormat('error', $exception->getMessage());
        }

        return response()->json($response);
    }

    /*
    public function show($id)
    {
        try {

            $xRiskFactorRating = AuditArea::find($id);
            $response = responseFormat('success', $xRiskFactorRating);

        }catch () {
            $response = responseFormat('error', $exception->getMessage());
        }

        return response()->json($response);
    }
    */

    public function update(Request $request, $id)
    {
        try {

            $xRiskFactorImpact = AuditArea::find($id);
            $xRiskFactorImpact->name_bn = strtolower($request->name_bn);
            $xRiskFactorImpact->name_en = strtolower($request->name_en);
            $xRiskFactorImpact->parent_id = $request->parent_id;
            $xRiskFactorImpact->sector_id = $request->sector_id;
            $xRiskFactorImpact->sector_type = $request->sector_type;
            $xRiskFactorImpact->updated_by = $request->updated_by;
            $xRiskFactorImpact->save();

            $response = responseFormat('success', 'Updated Successfully');

        } catch (\Exception $exception) {
            $response = responseFormat('error', $exception->getMessage());
        }

        return response()->json($response);
    }

    public function delete($id)
    {
        try {

            $xRiskImpact = AuditArea::find($id)->delete();

            $response = responseFormat('success', 'Deleted Successfully');


        } catch (\Exception $exception) {
            $response = responseFormat('error', $exception->getMessage());
        }

        return response()->json($response);
    }
}
