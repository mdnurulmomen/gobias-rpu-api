<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfficeLayerRequest extends FormRequest
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
            'office_ministry_id' => 'required|numeric',
            'custom_layer_id' => 'nullable|numeric',
            'parent_layer_id' => 'nullable|numeric',
            'layer_level' => 'nullable|numeric',
            'layer_sequence' => 'nullable|numeric',
            'layer_name_bng' => 'nullable|string',
            'layer_name_eng' => 'nullable|string',
            'created_by' => 'nullable',
            'modified_by' => 'nullable'
        ];
    }
}
