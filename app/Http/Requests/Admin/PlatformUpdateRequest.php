<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlatformUpdateRequest extends FormRequest
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

        foreach (config('app.supported_locales') as $key => $val) {
            $array['name_' . $key] = 'required|string|max:255';
        }

        $array['status'] = 'required|numeric';

        $array['formats'] = 'required|array|min:1';

        $array['formats.*'] = 'required|integer|exists:ads_formats,id';

        $array['cycles'] = 'required|array|min:1';

        $array['cycles.*'] = 'required|integer|exists:ads_cycles,id';

        return $array;
    }
}
