<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'  => 'required|max:191',
            'phone' => 'required|max:16',
            'time'  => 'required'
        ];
    }
}
