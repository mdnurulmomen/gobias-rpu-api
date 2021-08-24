<?php

namespace App\Http\Requests\ResponsibleParty;

use Illuminate\Foundation\Http\FormRequest;

class StoreResponsiblePartyRequest extends FormRequest
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
            'directorate_name_bn' => 'string',
            'directorate_name_en' => 'string',
            'office_ministry_id' => 'required|numeric',
            'controlling_office_layer_id' => 'required|numeric',
            'controlling_office_id' => 'required|numeric',
            'parent_office_layer_id' => 'nullable',
            'parent_office_id' => 'nullable',
            'cost_center_layer_id' => 'required|string',
            'cost_center_id' => 'required|numeric',
        ];
    }
}
