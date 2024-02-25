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
            'avatar'  =>'required',
            'phone' => 'required',
            'office_id' => 'required',
            // Add more validation rules as needed
        ];
    }
}



