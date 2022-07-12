<?php

namespace App\Http\Requests\Backend\Tag;

use Illuminate\Foundation\Http\FormRequest;

class TagCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'status'   => 'required|boolean',
        ];

        $languageRules = [
            'title'            => 'nullable|max:191',
            'description'      => 'nullable|max:5000',
        ];

        foreach (config('translatable.locales') as $locale) {
            foreach ($languageRules as $name => $rule) {
                $rules[$locale.'.'.$name] = $rule;
            }
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
