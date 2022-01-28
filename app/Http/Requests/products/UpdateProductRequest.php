<?php

namespace App\Http\Requests\products;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\traits\ProductTrait;


class UpdateProductRequest extends FormRequest
{
    use ProductTrait;
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
        $rules =  $this->productRules();
        $rules['image'] = ['nullable', 'max:1000', 'mimes:png,jpg,jpeg'];
        $rules['code']=['required','integer','digits:5','unique:products,code,'.$this->id];
        
        return $rules;
    }
}
