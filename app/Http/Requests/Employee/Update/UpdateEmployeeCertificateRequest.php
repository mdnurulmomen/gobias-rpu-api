<?php

namespace App\Http\Requests\Employee\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeCertificateRequest extends FormRequest
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
            'employee_record_id' => 'required|numeric',
            'lookup_certificate_id' => 'required|numeric',
            'certificate_institute_name' => 'required|string',
            'achievement_year' => 'required|numeric',
            'certificate_details' => 'required|string',
            'certificate_country_id' => 'required|numeric',
            'certificate_file_name' => 'mimes:png,jpg,jpeg,pdf|max:2048'
        ];
    }
}
