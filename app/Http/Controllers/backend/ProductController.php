<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\products\StoreProductRequest;
use App\Http\Requests\products\UpdateProductRequest;
use App\Http\traits\MediaTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use MediaTrait;
    public function index()
    {
        $products = DB::table('products')->get();
        $properties = ['Image','ID','Name EN','Code','Price','Quantity','Status','Created At','Action'];
        return view('backend.products.index',compact('products','properties'));
    } 
    public function create()
    {
        $brands = DB::table('brands')->get();
        $subcategories = DB::table('subcategories')->select('id','name_en')->where('status',1)->get();
        return view('backend.products.create',compact('brands','subcategories'));
    }

    public function edit($id)
    {
        $brands = DB::table('brands')->get();
        $subcategories = DB::table('subcategories')->select('id','name_en')->where('status',1)->get();
        $product = DB::table('products')->where('id',$id)->first(); 
        return view('backend.products.edit',compact('product','brands','subcategories'));
    }

    public function store(StoreProductRequest $request)
    {
        $photoName = $this->uploadPhoto($request->image,'products');
        $data = $request->except('_token','image','page');
        $data['image'] = $photoName;
        DB::table('products')->insert($data);
        return $this->redirectAccordingToRequest($request);
    }

    public function update(UpdateProductRequest $request , $id)
    {
        $data = $request->except('_token','_method','page','image');
        if($request->has('image')){
            $oldPhotoName = DB::table('products')->select('image')->where('id',$id)->first()->image;
            $photoPath = public_path('/dist/img/products/').$oldPhotoName;
            $this->deletePhoto($photoPath);
            $photoName = $this->uploadPhoto($request->image,'products');
            $data['image'] = $photoName;
        }
        DB::table('products')->where('id',$id)->update($data);
        return $this->redirectAccordingToRequest($request);
    }

    public function destroy($id)
    {
        $oldPhotoName = DB::table('products')->select('image')->where('id',$id)->first()->image;
        $photoPath = public_path('/dist/img/products/').$oldPhotoName;
        $this->deletePhoto($photoPath);
        DB::table('products')->where('id',$id)->delete();
        return redirect()->back()->with('success','Product has been deleted successfully');
    }

    private function redirectAccordingToRequest($request)
    {
        if($request->page == 'back'){
            return redirect()->back()->with('success','Product has been updated successfully');
        }else{
            return redirect()->route('products.index')->with('success','Product has been updated successfully');
        }
    }

}
