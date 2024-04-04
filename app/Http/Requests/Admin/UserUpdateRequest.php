<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            "firstname" => 'required|string|max:255',
            "lastname" => 'required|string|max:255',
            "email" => 'required|email|unique:users,email,' . $this->user,
            "role" => 'required|string|max:255',
            "parent_id" => 'nullable|exists:users,id',
            "country" => 'nullable|string|max:255',
            "city" => 'nullable|string|max:255',
            "address" => 'nullable|string|max:255',
            "phonenumber" => 'nullable|string|max:255',
            "status" => 'required|in:1,0',
        ];
    }
}
