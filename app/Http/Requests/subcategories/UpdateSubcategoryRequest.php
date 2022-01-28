<?php

namespace App\Http\Requests\subcategories;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\traits\SubcategoryTrait;


class UpdateSubcategoryRequest extends FormRequest
{
    use SubcategoryTrait;
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
        $rules =  $this->subcategoryRules();
        $rules['image'] = ['nullable', 'max:1000', 'mimes:png,jpg,jpeg'];
                
        return $rules;
    }
}
