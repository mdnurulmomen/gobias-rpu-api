<?php

namespace App\Http\Requests\Office;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfficeRequest extends FormRequest
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
            'office_ministry_id' => 'nullable|numeric',
            'office_layer_id' => 'nullable|numeric',
            'parent_office_layer_id' => 'numeric',
            'parent_office_id' => 'nullable|numeric',
            'controlling_office_layer_id' => 'numeric',
            'controlling_office_id' => 'numeric',
            'active_status' => 'nullable|numeric',
            'geo_division_id' => 'nullable|numeric',
            'geo_district_id' => 'nullable|numeric',
            'geo_upazila_id' => 'nullable|numeric',
            'geo_union_id' => 'nullable|numeric',
            'office_name_eng' => 'required|nullable|string',
            'office_name_bng' => 'required|nullable|string',
            'office_structure_type' => 'required|nullable|string',
            'office_address' => 'nullable|string',
            'office_phone' => 'nullable|string',
            'office_mobile' => 'nullable|numeric',
            'office_fax' => 'nullable|numeric',
            'office_email' => 'required|string',
            'office_web' => 'required|string|unique:App\Models\Office,office_web',
            'office_status' => 'nullable|numeric',
            'date_of_close' => 'nullable',
            'date_of_formation' => 'nullable',
            'actual_strength' => 'nullable',
            'office_description' => 'nullable',
            'office_details' => 'nullable',
            'office_document' => 'nullable',
        ];
    }
}
