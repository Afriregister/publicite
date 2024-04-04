<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdsPricePeriodRequest extends FormRequest
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
            
            'periods.*' => 'required|exists:periods,id',
            'period_ads_types.*' => 'required|exists:ads_types,id',
            'period_ads_formats.*' => 'required|exists:ads_formats,id',
            'period_price.*' => 'required|numeric',

        ];
    }
}
