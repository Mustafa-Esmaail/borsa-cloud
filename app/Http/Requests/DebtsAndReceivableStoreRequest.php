<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DebtsAndReceivableStoreRequest extends FormRequest
{

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
            'name'  => 'required',
            'amount'  => 'required',
            'currency_id'  => 'required|exists:currency,id',
            // 'office_id'  => 'required|exists:offices,id',
            'date'  => 'required',
            'type'  => 'required',
            'notes'  => 'nullable',
        ];
    }
}
