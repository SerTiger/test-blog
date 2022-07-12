<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class TranslationUpdateRequest extends FormRequest
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
            'value' => 'min:3|max:100'
        ];
    }

    public function messages()
    {
        return [
            'title.min' => 'Поле название должно быть более 3 символов.',
            'title.max' => 'Поле Название не должно превышать 100 символов.',

        ];
    }
}
