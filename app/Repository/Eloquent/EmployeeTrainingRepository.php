<?php

namespace App\Repository\Eloquent;

use App\Models\EmployeeTrainingDetail;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EmployeeTrainingRepository implements BaseRepositoryInterface
{

    public function store(Request $request, $cdesk)
    {
        $employeeTrainingDetail = new EmployeeTrainingDetail();
        $employeeTrainingDetail->employee_record_id = $request->employee_record_id;
        $employeeTrainingDetail->subject = trim($request->subject);
        $employeeTrainingDetail->lookup_id = $request->lookup_id;
        $employeeTrainingDetail->training_duration = trim($request->training_duration);
        $employeeTrainingDetail->training_institute = trim($request->training_institute);
        $employeeTrainingDetail->training_start_date = empty($request->training_start_date)?null:date('Y-m-d', strtotime($request->training_start_date));
        $employeeTrainingDetail->training_end_date = empty($request->training_end_date)?null:date('Y-m-d', strtotime($request->training_end_date));
        $employeeTrainingDetail->country_id = $request->country_id;
        $employeeTrainingDetail->created_by = $cdesk->user_primary_id;
        $employeeTrainingDetail->save();
    }

    public function update(Request $request, $cdesk)
    {
        $employeeTrainingDetail = EmployeeTrainingDetail::find($request->id);;
        $employeeTrainingDetail->employee_record_id = $request->employee_record_id;
        $employeeTrainingDetail->subject = trim($request->subject);
        $employeeTrainingDetail->lookup_id = $request->lookup_id;
        $employeeTrainingDetail->training_duration = trim($request->training_duration);
        $employeeTrainingDetail->training_institute = trim($request->training_institute);
        $employeeTrainingDetail->training_start_date = empty($request->training_start_date)?null:date('Y-m-d', strtotime($request->training_start_date));
        $employeeTrainingDetail->training_end_date = empty($request->training_end_date)?null:date('Y-m-d', strtotime($request->training_end_date));
        $employeeTrainingDetail->country_id = $request->country_id;
        $employeeTrainingDetail->updated_by = $cdesk->user_primary_id;
        $employeeTrainingDetail->save();
    }

    public function show($id)
    {
        return EmployeeTrainingDetail::where('id',$id)->first()->toArray();
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
