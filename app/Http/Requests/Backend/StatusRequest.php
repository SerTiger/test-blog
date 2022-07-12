<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
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
//        dd($this->all());
        $languageRules = [
            'title'     => 'required|max:100',
        ];

        $rules = [
            'active_state' => 'required|boolean'
        ];

        foreach (config('translatable.locales') as $locale) {
            foreach ($languageRules as $name => $rule) {
                $rules[$locale . '.' . $name] = $rule;
            }
        }

        return $rules;
    }
}
