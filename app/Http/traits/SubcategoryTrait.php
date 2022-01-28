<?php

namespace App\Http\traits;

trait SubcategoryTrait {
    public function subcategoryRules()
    {
        return [
            'name_en'=>['required','string','max:256','min:2'],
            'name_ar'=>['required','string','max:256','min:2'],
            'status'=>['required','integer','between:0,1'],
            'category_id'=>['required','integer','exists:subcategories,id'],
            'image'=>['required','max:1000','mimes:png,jpg,jpeg'],
        ];
    }
}