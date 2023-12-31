<?php

namespace App\Repository\Eloquent;

use App\Models\EmployeeCertificateDetail;
use App\Repository\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EmployeeCertificateRepository implements BaseRepositoryInterface
{

    public function store(Request $request, $cdesk)
    {
        if ($request->emp_certificate_id !== null) {
            $employeeCertificateDetail = EmployeeCertificateDetail::find($request->emp_certificate_id);
        }
        else{
            $employeeCertificateDetail = new EmployeeCertificateDetail();
        }

        $employeeCertificateDetail->employee_record_id = $request->employee_record_id;
        $employeeCertificateDetail->lookup_id = $request->lookup_certificate_id;
        $employeeCertificateDetail->institute_name = trim($request->institute_name);
        $employeeCertificateDetail->achievement_year = $request->achievement_year;
        $employeeCertificateDetail->description = trim($request->description);
        $employeeCertificateDetail->country_id = $request->country_id;
        $employeeCertificateDetail->created_by = $cdesk->user_primary_id;
        $employeeCertificateDetail->save();
    }

    public function update(Request $request, $cdesk)
    {
        $employeeCertificateDetail = EmployeeCertificateDetail::find($request->id);
        $employeeCertificateDetail->employee_record_id = $request->employee_record_id;
        $employeeCertificateDetail->lookup_id = $request->lookup_id;
        $employeeCertificateDetail->institute_name = trim($request->institute_name);
        $employeeCertificateDetail->achievement_year = $request->achievement_year;
        $employeeCertificateDetail->description = $request->description;
        $employeeCertificateDetail->country_id = $request->certificate_country_id;

        if($request->file('certificate_file_name')) {
            $file = $request->file('certificate_file_name');
            $filename = time() . '_' . $file->getClientOriginalName();

            // File upload location
            $location = 'files/certificate';
            // Upload file
            $file->move($location, $filename);
            $employeeCertificateDetail->certificate_file_name = $filename;
        }
        $employeeCertificateDetail->updated_by = $cdesk->user_primary_id;
        $employeeCertificateDetail->save();
    }

    public function show($id)
    {
        return EmployeeCertificateDetail::where('id',$id)->first()->toArray();
    }

    public function delete(Request $request, $cdesk)
    {
        return EmployeeCertificateDetail::where('id',$request->emp_certificate_id)->delete();
    }

    public function list(Request $request)
    {
        // TODO: Implement list() method.
    }

    public function getSingleEmployeeCertificateList(Request $request)
    {
        return EmployeeCertificateDetail::with(['certificate_name','country'])
            ->where('employee_record_id',$request->employee_record_id)
            ->get()
            ->toArray();
    }
}
