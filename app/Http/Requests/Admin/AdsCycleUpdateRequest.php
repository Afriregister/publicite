<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdsCycleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /*
        return [
            'name' => 'required|string|max:255|unique:ads_types,name,' . $this->adsType,
            'description' => 'nullable|string',
            'status' => 'required|numeric'
        ];
        */

        foreach (config('app.supported_locales') as $key => $val) {
            $array['name_' . $key] = 'required|string|max:255';
            $array['description_' . $key] = 'nullable|string';
        }

        $array['status'] = 'required|numeric';

        return $array;
    }
}
