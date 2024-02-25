<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic if needed
    }

    public function rules()
    {
        return [
            'amount'  => 'required',
            'sender_id'  => 'required',
            'receiver_id'  => 'required',
            'date'  => 'required',
            'currency'  =>'required',
            'percentage' => 'required',
            'total_amount' => 'required',
            'status' => 'required',
            'type' => 'required',
            // Add more validation rules as needed
        ];
    }
}


