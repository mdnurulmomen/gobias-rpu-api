<?php

namespace App\Http\Controllers;

use App\Models\EmployeeRecord;
use App\Models\User;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmployeeRecordController extends Controller
{
    public function storeEmployee(Request $request)
    {
        try {
            $validAttributeUpdate = $this->validate($request, [
                'name_bng' => 'required|string',
                'name_eng' => 'required|string',
                'identification_number' => 'nullable |string',
                'personal_email' => 'required |unique:App\Models\EmployeeRecord,personal_email',
                'official_email' => 'nullable |unique:App\Models\EmployeeRecord,official_email',
                'personal_mobile' => 'required |digits_between:11,14 |unique:App\Models\EmployeeRecord,personal_mobile',
                'official_mobile' => 'nullable |digits_between:11,14',
                'father_name_bng' => 'nullable |string',
                'father_name_eng' => 'nullable |string',
                'mother_name_bng' => 'nullable |string',
                'mother_name_eng' => 'nullable |string',
                'date_of_birth' => 'nullable',
                'nid' => 'required |unique :App\Models\EmployeeRecord,nid',
                'bcn' => 'nullable |numeric',
                'ppn' => 'nullable |numeric',
                'tin_number' => 'nullable |numeric',
                'gender' => 'required',
                'religion' => 'nullable |string',
                'blood_group' => 'nullable |string',
                'marital_status' => 'nullable |string',
                'alternative_mobile' => 'nullable |string',
                'is_cadre' => 'required|in:1,2,3',
                'employee_grade' => 'nullable',
                'joining_date' => 'nullable',
                'employee_batch_id' => 'nullable |string',
                'employee_cadre_id' => 'nullable |string',
                'identity_no' => 'nullable |numeric',
                'appointment_memo_no' => 'nullable |string',
                'mode_of_recruitment' => 'nullable |string',
                'handicapped_category' => 'nullable |string',
                'district_id' => 'nullable |numeric',
                'permanent_address' => 'nullable |string',
                'correspondence_address' => 'nullable |string',
                'mother_tongue_id' => 'nullable |numeric',
                'status' => 'nullable |numeric',
                'created_by' => 'nullable |numeric',
                'modified_by' => 'nullable |numeric',
            ], [
                'name_bng.required' => 'নাম বাংলা আবশ্যক',
                'name_eng.required' => 'নাম ইংরেজি আবশ্যক',
                'personal_email.required' => 'ব্যক্তিগত ইমেইল আবশ্যক',
                'personal_email.unique' => 'ব্যক্তিগত ইমেইল ব্যবহৃত হয়েছে',
                'personal_mobile.required' => 'ব্যক্তিগত মোবাইল আবশ্যক',
                'personal_mobile.min' => 'ব্যক্তিগত মোবাইল সর্বনিম্ন ১১',
                'personal_mobile.max' => 'ব্যক্তিগত মোবাইল সর্বোচ্চ ১৪',
                'personal_mobile.unique' => 'ব্যক্তিগত মোবাইল ব্যবহৃত হয়েছে',
                'nid.required' => 'জাতীয় পরিচয়পত্র নম্বর আবশ্যক',
                'nid.unique' => 'জাতীয় পরিচয়পত্র নম্বর ব্যবহৃত হয়েছে',
                'is_cadre.required' => 'ক্যাডার আবশ্যক',
                'gender.required' => 'লিঙ্গ আবশ্যক',
            ]);
//                dd($validAttributeUpdate);

            $dob = date('Y-m-d', strtotime($request->date_of_birth));
            $joining_date = date('Y-m-d', strtotime($request->joining_date));


            $validAttributeUpdate['date_of_birth'] = $dob;
            $validAttributeUpdate['joining_date'] = $joining_date;
            $validAttributeUpdate['status'] = 1;
            $validAttributeUpdate['created_by'] = 1;
            $validAttributeUpdate['modified_by'] = 1;

            $employee_id = EmployeeRecord::create($validAttributeUpdate);

            return response()->json(['status' => 'success', 'msg' => 'সফল্ভাবে যুক্ত করা হয়েছে।',
                'id'=>$employee_id->id, 'name' => $employee_id->name_bng]);
        }
        catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg' => $exception->errors(),
                'statusCode' => '422',
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => 'যুক্ত করা সম্ভব হয়নি।', 'data' => $e]);
        }

    }


    public function updateEmployee(Request $request)
    {
        try {

            $validAttributeUpdate = $this->validate($request, [
                'id' => 'nullable|numeric',
                'name_bng' => 'required|string',
                'name_eng' => 'required|string',
                'identification_number' => 'nullable |string',
                'personal_email' => 'required',
                'personal_mobile' => 'required|numeric|digits_between:11,14',
                'father_name_bng' => 'nullable |string',
                'father_name_eng' => 'nullable |string',
                'mother_name_bng' => 'nullable |string',
                'mother_name_eng' => 'nullable |string',
                'date_of_birth' => 'nullable ',
                'nid' => 'required',
                'bcn' => 'nullable |numeric',
                'ppn' => 'nullable |numeric',
                'gender' => 'required',
                'religion' => 'nullable |string',
                'blood_group' => 'nullable |string',
                'marital_status' => 'nullable |string',
                'alternative_mobile' => 'nullable |string',
                'is_cadre' => 'required |numeric',
                'employee_grade' => 'nullable',
                'joining_date' => 'nullable',
                'employee_batch_id' => 'nullable |string',
                'employee_cadre_id' => 'nullable |string',
                'identity_no' => 'nullable |numeric',
                'appointment_memo_no' => 'nullable |string',
                'status' => 'nullable |numeric',
                'created_by' => 'nullable |numeric',
                'modified_by' => 'nullable |numeric',
            ], [
                'name_bng.required' => 'নাম বাংলা আবশ্যক',
                'name_eng.required' => 'নাম ইংরেজি আবশ্যক',
                'personal_email.required' => 'ব্যক্তিগত ইমেইল আবশ্যক',
                'personal_email.unique' => 'ব্যক্তিগত ইমেইল ব্যবহৃত হয়েছে',
                'personal_mobile.required' => 'ব্যক্তিগত মোবাইল আবশ্যক',
                'personal_mobile.min' => 'ব্যক্তিগত মোবাইল সর্বনিম্ন ১১',
                'personal_mobile.max' => 'ব্যক্তিগত মোবাইল সর্বোচ্চ ১৪',
                'nid.required' => 'জাতীয় পরিচয়পত্র নম্বর আবশ্যক',
                'nid.unique' => 'জাতীয় পরিচয়পত্র নম্বর ব্যবহৃত হয়েছে',
                'is_cadre.required' => 'ক্যাডার আবশ্যক',
                'gender.required' => 'লিঙ্গ আবশ্যক',
            ]);

            $dob = date('Y-m-d', strtotime($request->date_of_birth));
            $joining_date = date('Y-m-d', strtotime($request->joining_date));


            $validAttributeUpdate['date_of_birth'] = $dob;
            $validAttributeUpdate['joining_date'] = $joining_date;
            $validAttributeUpdate['status'] = 1;
            $validAttributeUpdate['created_by'] = 1;
            $validAttributeUpdate['modified_by'] = 1;

            $employeeRecord = EmployeeRecord::find($request->id);
            $employeeRecord->update($validAttributeUpdate);

            return response()->json(['status' => 'success', 'msg' => 'সফল্ভাবে হালনাগাদ হয়েছে।',
                'id'=>$employeeRecord->id, 'name' => $employeeRecord->name_bng]);
        }
        catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg' => $exception->errors(),
                'statusCode' => '422',
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => 'যুক্ত করা সম্ভব হয়নি।', 'data' => $e]);
        }
    }
}
