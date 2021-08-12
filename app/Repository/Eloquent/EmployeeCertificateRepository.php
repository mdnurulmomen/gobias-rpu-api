<?php

namespace App\Repository\Eloquent;

use App\Models\EmployeeCertificateDetail;
use App\Models\EmployeeRecord;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;

class EmployeeCertificateRepository implements BaseRepositoryInterface
{

    public function create(Request $request, $cdesk)
    {
        $employeeCertificateDetail = new EmployeeCertificateDetail();
        $employeeCertificateDetail->employee_record_id = $request->employee_record_id;
        $employeeCertificateDetail->lookup_certificate_id = $request->lookup_certificate_id;
        $employeeCertificateDetail->certificate_institute_name = $request->certificate_institute_name;
        $employeeCertificateDetail->achievement_year = $request->achievement_year;
        $employeeCertificateDetail->certificate_details = $request->certificate_details;
        $employeeCertificateDetail->certificate_country_id = $request->certificate_country_id;

        if($request->file('certificate_file_name')) {
            $file = $request->file('certificate_file_name');
            $filename = time() . '_' . $file->getClientOriginalName();

            // File upload location
            $location = 'files/certificate';
            // Upload file
            $file->move($location, $filename);
            $employeeCertificateDetail->certificate_file_name = $filename;
        }
        $employeeCertificateDetail->modified_by = $cdesk->officer_id;
        $employeeCertificateDetail->created_by = $cdesk->officer_id;
        $employeeCertificateDetail->save();
    }

    public function update(Request $request, $cdesk)
    {
        $employeeRecord = EmployeeRecord::find($request->employee_id);
        $employeeRecord->name_bng = $request->name_bng;
        $employeeRecord->name_eng = $request->name_eng;
        $employeeRecord->identification_number = $request->identification_number;
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
        $employeeRecord->status = $request->status;
        $employeeRecord->modified_by = $cdesk->officer_id;
        $employeeRecord->created_by = $cdesk->officer_id;
        $employeeRecord->save();
    }

    public function show(Request $request)
    {
        // TODO: Implement show() method.
    }

    public function delete(Request $request, $cdesk)
    {
        // TODO: Implement delete() method.
    }
}
