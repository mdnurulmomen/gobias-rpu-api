<?php

namespace App\Http\Requests\Employee\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeTrainingRequest extends FormRequest
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
            'subject' => 'required|string',
            'lookup_training_type_id' => 'required|numeric',
            'training_institute' => 'required|string',
            'training_duration' => 'required|string',
            'training_start_date' => 'required',
            'training_end_date' => 'required',
            'country_id' => 'required|numeric',
        ];
    }
}
