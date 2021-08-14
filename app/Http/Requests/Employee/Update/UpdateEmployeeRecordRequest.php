<?php

namespace App\Http\Requests\Employee\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRecordRequest extends FormRequest
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
            'id' => 'required|numeric',
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
            //'personal_mobile.min' => 'ব্যক্তিগত মোবাইল সর্বনিম্ন ১১',
            //'personal_mobile.max' => 'ব্যক্তিগত মোবাইল সর্বোচ্চ ১৪',
            'nid.required' => 'জাতীয় পরিচয়পত্র নম্বর আবশ্যক',
            'nid.unique' => 'জাতীয় পরিচয়পত্র নম্বর ব্যবহৃত হয়েছে',
            'is_cadre.required' => 'ক্যাডার আবশ্যক',
            'gender.required' => 'লিঙ্গ আবশ্যক',
        ];
    }
}
