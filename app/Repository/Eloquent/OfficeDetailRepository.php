<?php

namespace App\Repository\Eloquent;

use App\Models\OfficeDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OfficeDetailRepository
{

    public function store(Request $request,$officeId,$cdesk)
    {
        $officeDetail = new OfficeDetail();
        $officeDetail->office_id = $officeId;
        $officeDetail->board_of_directors = $request->board_of_directors;
        $officeDetail->organizational_structure = $request->organizational_structure;
        $officeDetail->summary_of_manpower = $request->summary_of_manpower;
        $officeDetail->important_feature_of_entity = $request->important_feature_of_entity;
        $officeDetail->mission = $request->mission;
        $officeDetail->vision = $request->vision;
        $officeDetail->financial_statements = $request->financial_statements;
        $officeDetail->revenue_expenditure = $request->revenue_expenditure;
        $officeDetail->capital_expenditure = $request->capital_expenditure;
        $officeDetail->created_by = $cdesk->user_primary_id;
        $officeDetail->save();
    }

    public function show($officeId){
        // TODO: Implement show() method.
    }

    public function update(Request $request, $cdesk)
    {
        if(empty($request->office_detail_id)){
            $officeDetail = new OfficeDetail();
            $officeDetail->office_id = $request->id;
        }
        else{
            $officeDetail = OfficeDetail::find($request->office_detail_id);
        }
        $officeDetail->board_of_directors = $request->board_of_directors;
        $officeDetail->organizational_structure = $request->organizational_structure;
        $officeDetail->summary_of_manpower = $request->summary_of_manpower;
        $officeDetail->important_feature_of_entity = $request->important_feature_of_entity;
        $officeDetail->mission = $request->mission;
        $officeDetail->vision = $request->vision;
        $officeDetail->financial_statements = $request->financial_statements;
        $officeDetail->revenue_expenditure = $request->revenue_expenditure;
        $officeDetail->capital_expenditure = $request->capital_expenditure;
        $officeDetail->updated_by = $cdesk->user_primary_id;
        $officeDetail->save();
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }

    public function list(Request $request)
    {
        // TODO: Implement list() method.
    }
}
