<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManualOfficeStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic if needed
    }

    public function rules()
    {
        return [
            'office_name'  => 'required',
            'office_owner'  => 'required',
            'country'  => 'required',
            'city'  => 'required',
            'phone' => 'required',
            'address' => 'required',

            // 'currency_id'  => 'required|exists:currency,id',
            'office_id'  => 'required|exists:offices,id',
            // Add more validation rules as needed
        ];
    }
}



