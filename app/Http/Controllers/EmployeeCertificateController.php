<?php


namespace App\Http\Controllers;


use App\Http\Requests\StoreEmployeeRecordRequest;
use App\Http\Requests\UpdateEmployeeRecordRequest;
use App\Models\EmployeeCertificateDetail;
use App\Services\EmployeeRecordService;
use Illuminate\Http\Request;

class EmployeeCertificateController extends Controller
{
    public function store(StoreEmployeeRecordRequest $request, EmployeeRecordService $employeeRecordService): \Illuminate\Http\JsonResponse
    {
        $storeEmployeeRecord = $employeeRecordService->store($request);
        if (isSuccessResponse($storeEmployeeRecord)) {
            $response = responseFormat('success', $storeEmployeeRecord['data']);
        } else {
            $response = responseFormat('error', $storeEmployeeRecord['data']);
        }
        return response()->json($response);
    }

    public function update(UpdateEmployeeRecordRequest $request, EmployeeRecordService $employeeRecordService): \Illuminate\Http\JsonResponse
    {
        $storeEmployeeRecord = $employeeRecordService->update($request);
        if (isSuccessResponse($storeEmployeeRecord)) {
            $response = responseFormat('success', $storeEmployeeRecord['data']);
        } else {
            $response = responseFormat('error', $storeEmployeeRecord['data']);
        }
        return response()->json($response);
    }


    /*public function store(Request $request)
    {
        $validAttribute = request()->validate([
            'employee_record_id' => 'required|numeric',
            'lookup_certificate_id' => 'required|numeric',
            'certificate_institute_name' => 'required|string',
            'achievement_year' => 'required|numeric',
            'certificate_details' => 'required|string',
            'certificate_country_id' => 'required|numeric',
            'certificate_file_name' => 'mimes:png,jpg,jpeg,pdf|max:2048'
        ]);

        $validAttribute['lookup_id'] = $request->lookup_certificate_id;
        $validAttribute['institute_name'] = $request->certificate_institute_name;
        $validAttribute['description'] = $request->certificate_details;
        $validAttribute['country_id'] = $request->certificate_country_id;
        $validAttribute['created_by'] = auth()->user()->id;
        //dd($validAttribute);

        if($request->file('certificate_file_name')) {
            $file = $request->file('certificate_file_name');
            $filename = time() . '_' . $file->getClientOriginalName();

            // File upload location
            $location = 'files/certificate';
            // Upload file
            $file->move($location, $filename);
            $validAttribute['certificate_file_name'] = $filename;
        }


        if (!empty($request->emp_certificate_detail_id)) {
            $employeeCertificateDetail = EmployeeCertificateDetail::find($request->emp_certificate_detail_id);
            $employeeCertificateDetail->update($validAttribute);
            return response(['status' => 'success', 'msg' => 'সফল্ভাবে হালনাগাদ হয়েছে।']);
        }

        else {
            EmployeeCertificateDetail::create($validAttribute);

            return response()->json([
                'status' => 'success',
                'msg' => 'সফল্ভাবে যুক্ত করা হয়েছে।'
            ]);
        }
    }*/

}
