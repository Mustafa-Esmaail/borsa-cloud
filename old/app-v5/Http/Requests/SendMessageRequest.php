<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
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
            'message'=>'nullable',
            // 'img'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            // 'voice'=>'nullable|mimetypes:audio/mpeg,audio/ogg,video/mp4|max:10240',
            'message_type' => 'required|in:text,img,voice',
            'receiver_id'=>'required|numeric|exists:offices,id',
        ];
    }
}
