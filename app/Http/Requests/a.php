<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCurrencyToOffice extends FormRequest
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
            //
            'sell_price'  => 'nullable|string',
            'buy_price'  => 'nullable|string',
            'currency_id'  => 'requird|exists:currency,id',
        ];
    }
}
