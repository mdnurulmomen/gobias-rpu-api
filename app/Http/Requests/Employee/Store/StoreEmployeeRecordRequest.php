<?php

namespace App\Http\Requests\Employee\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'cdesk' => 'required|json',
            'name_bng' => 'required|string',
            'name_eng' => 'required|string',
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
        ];
    }

    public function messages()
    {
        return [
            'name_bng.required' => 'নাম বাংলা আবশ্যক',
            'name_eng.required' => 'নাম ইংরেজি আবশ্যক',
            'personal_email.required' => 'ব্যক্তিগত ইমেইল আবশ্যক',
            'personal_email.unique' => 'ব্যক্তিগত ইমেইল ব্যবহৃত হয়েছে',
            'personal_mobile.required' => 'ব্যক্তিগত মোবাইল আবশ্যক',
            'personal_mobile.unique' => 'ব্যক্তিগত মোবাইল ব্যবহৃত হয়েছে',
            'nid.required' => 'জাতীয় পরিচয়পত্র নম্বর আবশ্যক',
            'nid.unique' => 'জাতীয় পরিচয়পত্র নম্বর ব্যবহৃত হয়েছে',
            'is_cadre.required' => 'ক্যাডার আবশ্যক',
            'gender.required' => 'লিঙ্গ আবশ্যক',
        ];
    }
}
