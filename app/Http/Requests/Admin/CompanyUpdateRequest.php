<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
        return [
            "user_id" => "required|exists:users,id",
            "name" => 'required|unique:companies,name,' . $this->company,
            "tin" => 'nullable|string|max:255',
            "country" => 'nullable|string|max:255',
            "city" => 'nullable|string|max:255',
            "address" => 'nullable|string|max:255',
            "phonenumber" => 'nullable|string|max:255',
            "email" => 'nullable|email',
            "website" => 'nullable|url'
        ];
    }
}
