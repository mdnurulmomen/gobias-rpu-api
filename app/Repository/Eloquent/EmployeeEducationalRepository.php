<?php

namespace App\Repository\Eloquent;

use App\Models\EmployeeEducationalDetail;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EmployeeEducationalRepository implements BaseRepositoryInterface
{

    public function store(Request $request, $cdesk)
    {
        if ($request->emp_education_id !== null) {
            $employeeEducationalDetail = EmployeeEducationalDetail::find($request->emp_education_id);
        }
        else{
            $employeeEducationalDetail = new EmployeeEducationalDetail();
        }

        $employeeEducationalDetail->employee_record_id = $request->employee_record_id;
        $employeeEducationalDetail->lookup_id = $request->lookup_degree_id;
        $employeeEducationalDetail->board_name = trim($request->board_name);
        $employeeEducationalDetail->institute_name = trim($request->institute_name);
        $employeeEducationalDetail->subject_name = trim($request->subject_name);
        $employeeEducationalDetail->passing_year = trim($request->passing_year);
        $employeeEducationalDetail->created_by = $cdesk->user_primary_id;
        $employeeEducationalDetail->save();
    }

    public function update(Request $request, $cdesk)
    {
        $employeeEducationalDetail = EmployeeEducationalDetail::find($request->id);
        $employeeEducationalDetail->employee_record_id = $request->employee_record_id;
        $employeeEducationalDetail->lookup_id = $request->lookup_id;
        $employeeEducationalDetail->board_name = trim($request->board_name);
        $employeeEducationalDetail->institute_name = trim($request->institute_name);
        $employeeEducationalDetail->subject_name = trim($request->subject_name);
        $employeeEducationalDetail->passing_year = trim($request->passing_year);
        $employeeEducationalDetail->save();
    }

    public function show($id)
    {
        return EmployeeEducationalDetail::where('id',$id)->first()->toArray();
    }

    public function delete(Request $request, $cdesk)
    {
        return EmployeeEducationalDetail::where('id',$request->emp_education_id)->delete();
    }

    public function list(Request $request)
    {
        // TODO: Implement list() method.
    }

    public function getSingleEmployeeEducationList(Request $request)
    {
        return EmployeeEducationalDetail::with(['degree'])
            ->where('employee_record_id',$request->employee_record_id)
            ->get()
            ->toArray();
    }
}
