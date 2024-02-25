<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionConfirmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            //
            'amount'  => 'required',
            'sender_id'  => 'required|exists:offices,id',
            'receiver_id'  => 'required|exists:offices,id',
            'date'  => 'required',
            // 'currency'  =>'required',
            'percentage' => 'required',
            'status' => 'required',
            'type' => 'required',
            'action' => 'required',
            // 'office_id' => 'required',
            'currency_id'  => 'required|exists:currency,id',
            'office_id'  => 'required|exists:offices,id',
        ];

    }
}
