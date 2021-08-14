<?php

namespace App\Http\Requests\Employee\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeEducationalRequest extends FormRequest
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
            'lookup_degree_id' => 'required|numeric',
            'board_name' => 'nullable|string',
            'institute_name' => 'required|string',
            'subject_name' => 'required|string',
            'passing_year' => 'required|numeric'
        ];
    }
}
