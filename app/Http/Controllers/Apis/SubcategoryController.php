<?php

namespace App\Http\Controllers\Apis;

use App\Http\traits\MediaTrait;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\subcategories\StoreSubcategoryRequest;
use App\Http\Requests\subcategories\UpdateSubcategoryRequest;
use App\Http\traits\ApiTrait;

class SubcategoryController extends Controller
{
    use MediaTrait,ApiTrait;
   public function index()
   {
       $subcategories = Subcategory::all(); 
       return $this->Data(compact('subcategories'));
   }

   public function create()
   {
        $categories = Category::select('id','name_en')->get();
        return $this->Data(compact('categories'));
   }
 
   public function edit($id)
   {
        $categories = Category::select('id','name_en')->get();
        $subcategory = Subcategory::findOrFail($id);
        return $this->Data(compact('subcategory','categories'));
   }

   public function store(StoreSubcategoryRequest $request)
    {
        $photoName = $this->uploadPhoto($request->image,'subcategories');
        $data = $request->except('image');
        $data['image'] = $photoName;
        Subcategory::create($data);
        return $this->SuccessMessage("Subcategory has been created successfully",201);
    }

    public function update(UpdateSubcategoryRequest $request , $id)
    {
        $data = $request->except('image','_method');
        if($request->has('image')){
            $oldPhotoName = Subcategory::find($id)->image;
            $photoPath = public_path('/dist/img/subcategories/').$oldPhotoName;
            $this->deletePhoto($photoPath);
            $photoName = $this->uploadPhoto($request->image,'subcategories');
            $data['image'] = $photoName;
        }
        Subcategory::where('id',$id)->update($data);
        return $this->SuccessMessage('Subcategory has been updated successfully'); // return success message
    }

    public function destroy($id)
    {
        $product = Subcategory::find($id);
        if($product){
            $oldPhotoName = $product->image;
            $photoPath = public_path('/dist/img/products/').$oldPhotoName;
            $this->deletePhoto($photoPath);
            Subcategory::where('id',$id)->delete();
            return $this->SuccessMessage('Subcategory has been deleted successfully'); // return success message
        }else{
            return $this->ErrorMessage(['id'=>'Invalid ID'],'The given data was invalid',422); // return Error message
        }
        
    }
}
