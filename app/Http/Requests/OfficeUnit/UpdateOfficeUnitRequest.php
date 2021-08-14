<?php

namespace App\Http\Requests\OfficeUnit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfficeUnitRequest extends FormRequest
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
            'office_ministry_id' => 'required|numeric',
            'office_unit_category' => 'required|numeric',
            'office_layer_id' => 'required|numeric',
            'office_id' => 'required|numeric',
            'parent_unit_id' => 'numeric',
            'unit_name_bng' => 'required|string',
            'unit_name_eng' => 'required|string',

        ];
    }
}
