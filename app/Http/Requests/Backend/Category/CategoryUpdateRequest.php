<?php

namespace App\Http\Requests\Backend\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $page = $this->route()->parameter('category');

        $rules = [
            'status'   => 'required|boolean',
            'slug'     => 'unique:pages,slug,'.$page->id.',id',
            'position' => 'required|numeric',
        ];

        $languageRules = [
            'title'            => 'nullable|max:191',
            'description'      => 'nullable|max:5000',
            'meta_title'       => 'nullable|max:191',
            'meta_keywords'    => 'nullable|max:191',
            'meta_description' => 'nullable|max:5000',
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
