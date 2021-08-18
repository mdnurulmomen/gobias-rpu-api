<?php

namespace App\Http\Requests\Employee\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeCertificateRequest extends FormRequest
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
            'employee_record_id' => 'required|numeric',
            'lookup_certificate_id' => 'required|numeric',
            'institute_name' => 'required|string',
            'achievement_year' => 'required|numeric',
            'description' => 'required|string',
            'country_id' => 'required|numeric',
            'certificate_file_name' => 'mimes:png,jpg,jpeg,pdf|max:2048'
        ];
    }
}
