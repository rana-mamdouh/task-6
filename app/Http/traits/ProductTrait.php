<?php

namespace App\Http\traits;

trait ProductTrait {
    public function productRules()
    {
        return [
            'name_en'=>['required','string','max:256','min:2'],
            'name_ar'=>['required','string','max:256','min:2'],
            'price'=>['required','numeric','max:99999.99','min:1'],
            'code'=>['required','integer','digits:5','unique:products'],
            'quantity'=>['nullable','integer','max:999','min:1'],
            'desc_en'=>['required','string'],
            'desc_ar'=>['required','string'],
            'status'=>['required','integer','between:0,1'],
            'subcategory_id'=>['required','integer','exists:subcategories,id'],
            'brand_id'=>['required','integer','exists:brands,id'],
            'image'=>['required','max:1000','mimes:png,jpg,jpeg'],
        ];
    }
}