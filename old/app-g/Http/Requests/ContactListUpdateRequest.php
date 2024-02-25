<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactListUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            //
            // 'office_id'   => 'required|exists:offices,id',
            'contact_id'  => 'required|exists:offices,id',
            'status'      => 'required'
        ];
    }
}
