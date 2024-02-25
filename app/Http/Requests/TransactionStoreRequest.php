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
            'receiver_id'  => 'required',
            'date'  => 'required|date',
            'currency_id'  =>'required|exists:currency,id',
            'percentage' => 'required',
            'total_amount' => 'required',
            // 'office_type' => 'required',
            'sender_name'=> 'required',
             'receiver_name' => 'required',
            'type' => 'required',
            'notes' => 'string|nullable',
            // 'holder_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'holde_notes' => 'string|nullable',
            // Add more validation rules as needed
        ];
    }
}


