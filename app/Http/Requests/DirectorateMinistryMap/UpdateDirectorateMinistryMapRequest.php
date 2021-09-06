<?php

namespace App\Http\Requests\DirectorateMinistryMap;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDirectorateMinistryMapRequest extends FormRequest
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
            'directorate_id' => 'required|numeric',
            'directorate_name_bn' => 'required|string',
            'directorate_name_en' => 'required|string',
            'office_ministry_id' => 'required|numeric',
        ];
    }
}
