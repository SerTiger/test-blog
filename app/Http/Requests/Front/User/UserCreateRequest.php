<?php

namespace App\Http\Requests\Front\User;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'phone'       => 'required|string|max:255',
            'country'     => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'password'    => 'required|confirmed|min:8',
        ];
    }
}
