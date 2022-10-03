<?php

namespace App\Http\Requests\Backend\Password;

use Illuminate\Foundation\Http\FormRequest;

class RestorePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token'            => 'required|string|max:255',
            'email'            => 'required|email|max:255|exists:users',
            'password'         => 'required|confirmed|min:8',
        ];
    }
}