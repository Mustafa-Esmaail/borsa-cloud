<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Adjust authorization logic if needed
    }

    public function rules()
    {
        return [
            'amount'  => 'required',
            'date'  => 'required|date',
            'currency'  =>'required|exists:currency,id',
            'percentage' => 'required',
            'total_amount' => 'required',
            // 'office_type' => 'required',
            'type' => 'required',
            'notes' => 'string|nullable',

            // Add more validation rules as needed
        ];
    }
}
