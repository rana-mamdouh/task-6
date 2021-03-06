<?php

namespace App\Http\Requests\products;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\traits\ProductTrait;

class StoreProductRequest extends FormRequest
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
        return $this->productRules();
    }
}
