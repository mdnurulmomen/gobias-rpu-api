<?php

namespace App\Repository\Eloquent;

use App\Models\EmployeeRecord;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EmployeeRecordRepository implements BaseRepositoryInterface
{

    public function store(Request $request, $cdesk)
    {
        $employeeRecord = new EmployeeRecord();
        $employeeRecord->name_bng = $request->name_bng;
        $employeeRecord->name_eng = $request->name_eng;
        $employeeRecord->personal_email = $request->personal_email;
        $employeeRecord->official_email = $request->official_email;
        $employeeRecord->personal_mobile = $request->personal_mobile;
        $employeeRecord->official_mobile = $request->official_mobile;
        $employeeRecord->alternative_mobile = $request->alternative_mobile;
        $employeeRecord->father_name_bng = $request->father_name_bng;
        $employeeRecord->father_name_eng = $request->father_name_eng;
        $employeeRecord->mother_name_bng = $request->mother_name_bng;
        $employeeRecord->mother_name_eng = $request->mother_name_eng;

        //for date of birth
        $dob = empty($request->date_of_birth)?null:date('Y-m-d', strtotime($request->date_of_birth));
        $employeeRecord->date_of_birth = $dob;

        $employeeRecord->nid = $request->nid;
        $employeeRecord->bcn = $request->bcn;
        $employeeRecord->ppn = $request->ppn;
        $employeeRecord->tin_number = $request->tin_number;
        $employeeRecord->gender = $request->gender;
        $employeeRecord->religion = $request->religion;
        $employeeRecord->blood_group = $request->blood_group;
        $employeeRecord->marital_status = $request->marital_status;
        $employeeRecord->is_cadre = $request->is_cadre;
        $employeeRecord->employee_grade = $request->employee_grade;

        //for joining date
        $joining_date = empty($request->joining_date)?null:date('Y-m-d', strtotime($request->joining_date));
        $employeeRecord->joining_date = $joining_date;

        $employeeRecord->employee_batch_id = $request->employee_batch_id;
        $employeeRecord->employee_cadre_id = $request->employee_cadre_id;
        $employeeRecord->identity_no = $request->identity_no;
        $employeeRecord->appointment_memo_no = $request->appointment_memo_no;
        $employeeRecord->mode_of_recruitment = $request->mode_of_recruitment;
        $employeeRecord->handicapped_category = $request->handicapped_category;
        $employeeRecord->district_id = $request->district_id;
        $employeeRecord->permanent_address = $request->permanent_address;
        $employeeRecord->correspondence_address = $request->correspondence_address;
        $employeeRecord->mother_tongue_id = $request->mother_tongue_id;
        $employeeRecord->status = 1;
        $employeeRecord->created_by = $cdesk->user_primary_id;
        $employeeRecord->save();

        return $employeeRecord->id;
    }

    public function update(Request $request, $cdesk)
    {
        $employeeRecord = EmployeeRecord::find($request->id);
        $employeeRecord->official_email = $request->official_email;
        $employeeRecord->official_mobile = $request->official_mobile;
        $employeeRecord->alternative_mobile = $request->alternative_mobile;
        $employeeRecord->father_name_bng = $request->father_name_bng;
        $employeeRecord->father_name_eng = $request->father_name_eng;
        $employeeRecord->mother_name_bng = $request->mother_name_bng;
        $employeeRecord->mother_name_eng = $request->mother_name_eng;

        $employeeRecord->bcn = $request->bcn;
        $employeeRecord->ppn = $request->ppn;
        $employeeRecord->tin_number = $request->tin_number;
        $employeeRecord->gender = $request->gender;
        $employeeRecord->religion = $request->religion;
        $employeeRecord->blood_group = $request->blood_group;
        $employeeRecord->marital_status = $request->marital_status;
        $employeeRecord->employee_grade = $request->employee_grade;

        //for joining date
        $joining_date = empty($request->joining_date)?null:date('Y-m-d', strtotime($request->joining_date));
        $employeeRecord->joining_date = $joining_date;

        $employeeRecord->employee_batch_id = $request->employee_batch_id;
        $employeeRecord->employee_cadre_id = $request->employee_cadre_id;
        $employeeRecord->identity_no = $request->identity_no;
        $employeeRecord->appointment_memo_no = $request->appointment_memo_no;
        $employeeRecord->mode_of_recruitment = $request->mode_of_recruitment;
        $employeeRecord->handicapped_category = $request->handicapped_category;
        $employeeRecord->district_id = $request->district_id;
        $employeeRecord->permanent_address = $request->permanent_address;
        $employeeRecord->correspondence_address = $request->correspondence_address;
        $employeeRecord->mother_tongue_id = $request->mother_tongue_id;
        $employeeRecord->status = 1;
        $employeeRecord->modified_by = $cdesk->user_primary_id;
        $employeeRecord->save();
    }

    public function show($id)
    {
        return EmployeeRecord::where('id',$id)->first()->toArray();
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }

    public function list(Request $request)
    {
        // TODO: Implement list() method.
    }

    public function search(Request $request)
    {

        $name_eng  = trim($request->name_eng);
        $name_bng = trim($request->name_bng);
        $personal_email  = trim($request->personal_email);
        $official_email  = trim($request->official_email);
        $personal_mobile = trim($request->personal_mobile);
        $official_mobile = trim($request->official_mobile);
        $alternative_mobile = trim($request->alternative_mobile);
        $nid = trim($request->nid);
        $date_of_birth = $request->date_of_birth;
        $gender = trim($request->gender);
        $religion = trim($request->religion);
        $blood_group = trim($request->blood_group);
        $marital_status = trim($request->marital_status);
        $is_cadre = trim($request->is_cadre);
        $employee_grade = trim($request->employee_grade);
        $employee_batch_id = trim($request->employee_batch_id);
        $employee_cadre_id = trim($request->employee_cadre_id);
        $district_id = trim($request->district_id);

        $query = EmployeeRecord::query();

        $query->when($name_eng, function ($q, $name_eng) {
            return $q->where('name_eng', $name_eng);
        });

        $query->when($name_bng, function ($q, $name_bng) {
            return $q->where('name_bng', $name_bng);
        });

        $query->when($personal_email, function ($q, $personal_email) {
            return $q->where('personal_email', $personal_email);
        });

        $query->when($official_email, function ($q, $official_email) {
            return $q->where('official_email', $official_email);
        });

        $query->when($official_mobile, function ($q, $official_mobile) {
            return $q->where('official_mobile', $official_mobile);
        });

        $query->when($alternative_mobile, function ($q, $alternative_mobile) {
            return $q->where('alternative_mobile', $alternative_mobile);
        });

        $query->when($nid, function ($q, $nid) {
            return $q->where('nid', $nid);
        });

        $query->when($gender, function ($q, $gender) {
            return $q->where('gender', $gender);
        });

        $query->when($religion, function ($q, $religion) {
            return $q->where('religion', $religion);
        });

        $query->when($blood_group, function ($q, $blood_group) {
            return $q->where('blood_group', $blood_group);
        });

        $query->when($marital_status, function ($q, $marital_status) {
            return $q->where('marital_status', $marital_status);
        });

        $query->when($is_cadre, function ($q, $is_cadre) {
            return $q->where('is_cadre', $is_cadre);
        });

        $query->when($employee_grade, function ($q, $employee_grade) {
            return $q->where('employee_grade', $employee_grade);
        });

        $query->when($employee_batch_id, function ($q, $employee_batch_id) {
            return $q->where('employee_batch_id', $employee_batch_id);
        });

        $query->when($employee_cadre_id, function ($q, $employee_cadre_id) {
            return $q->where('employee_cadre_id', $employee_cadre_id);
        });

        $query->when($district_id, function ($q, $district_id) {
            return $q->where('district_id', $district_id);
        });

        return $query->get()->toArray();
    }

    //for profile
    public function profile($id)
    {
        return EmployeeRecord::with('user','educational_qualifications','educational_qualifications.degree',
            'training_experiences','training_experiences.audit_type','training_experiences.country',
            'language_proficiencies')
            ->find($id)
            ->toArray();
    }

    //for employee datatable
    public function employeeDatatable(Request $request){
        $limit = $request->length;
        $start = $request->start;
        $order = $request->order;
        $dir = $request->dir;


        if (empty($request->search)) {
            $totalData = EmployeeRecord::count();
            $employees = EmployeeRecord::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }

        else {
            $search = $request->search;

            $commonSql = EmployeeRecord::where('name_eng', 'like', '%' .$search . '%')
                ->orWhere('name_bng', 'LIKE',"%{$search}%")
                ->orWhere('personal_mobile', 'LIKE',"%{$search}%")
                ->orWhere('personal_email', 'LIKE',"%{$search}%");

            $totalData = $commonSql->count();
            $employees = $commonSql->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }

        $response = array(
            "employees"=> $employees,
            "totalData"=>$totalData,
            "totalFiltered"=>$totalData
        );
        return $response;
    }
}
