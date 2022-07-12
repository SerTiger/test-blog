<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string',
            'message'    => 'nullable|string|max:5000',
            'product_id' => 'nullable|numeric|exists:products,id',
            'products'   => 'nullable|array',
            'products.*.product_id'=>'required|numeric|exists:products,id',
            'products.*.amount'=>'required|numeric|min:0',
        ];
    }
}
