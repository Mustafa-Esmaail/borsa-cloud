<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusStoreRequest extends FormRequest
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
            'sell_price'   => 'required',
            'buy_price'   => 'required',
            // 'office_id'  => 'requi   red|exists:offices,id',
            'currency_id'  => 'required|exists:currency,id',

        ];
    }
}
