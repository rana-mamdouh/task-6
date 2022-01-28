<?php

namespace App\Http\Controllers\Apis;

use App\Models\Brand;
use App\Models\Product;
use App\Http\traits\MediaTrait;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\products\StoreProductRequest;
use App\Http\Requests\products\UpdateProductRequest;
use App\Http\traits\ApiTrait;

class ProductController extends Controller
{
    use MediaTrait,ApiTrait;
   public function index()
   {
       $products = Product::all(); 
       return $this->Data(compact('products'));
   }

   public function create()
   {
        $brands = Brand::all();
        $subcategories = Subcategory::select('id','name_en')->get();
        return $this->Data(compact('brands','subcategories'));
   }
 
   public function edit($id)
   {
        $brands = Brand::all();
        $subcategories = Subcategory::select('id','name_en')->get();
        $product = Product::findOrFail($id);
        return $this->Data(compact('product','brands','subcategories'));

   }

   public function store(StoreProductRequest $request)
    {
        $photoName = $this->uploadPhoto($request->image,'products');
        $data = $request->except('image');
        $data['image'] = $photoName;
        Product::create($data);
        return $this->SuccessMessage("Product has been created successfully",201);
    }

    public function update(UpdateProductRequest $request , $id)
    {
        $data = $request->except('image','_method');
        if($request->has('image')){
            $oldPhotoName = Product::find($id)->image;
            $photoPath = public_path('/dist/img/products/').$oldPhotoName;
            $this->deletePhoto($photoPath);
            $photoName = $this->uploadPhoto($request->image,'products');
            $data['image'] = $photoName;
        }
        Product::where('id',$id)->update($data);
        return $this->SuccessMessage('Product has been updated successfully'); // return success message
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if($product){
            $oldPhotoName = $product->image;
            $photoPath = public_path('/dist/img/products/').$oldPhotoName;
            $this->deletePhoto($photoPath);
            Product::where('id',$id)->delete();
            return $this->SuccessMessage('Product has been deleted successfully'); // return success message
        }else{
            return $this->ErrorMessage(['id'=>'Invalid ID'],'The given data was invalid',422); // return Error message
        }
        
    }
}
