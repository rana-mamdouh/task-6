<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\subcategories\StoreSubcategoryRequest;
use App\Http\Requests\subcategories\UpdateSubcategoryRequest;
use App\Http\traits\MediaTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    use MediaTrait;
    public function index()
    {
        $subcategories = DB::table('subcategories')->get();
        $properties = ['Image', 'ID', 'Name EN', 'Status', 'Created At', 'Action'];
        return view('backend.subcategories.index', compact('subcategories', 'properties'));
    }
    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('backend.subcategories.create', compact('categories'));
    }

    public function edit($id)
    {
        $categories = DB::table('categories')->select('id', 'name_en')->where('status', 1)->get();
        $subcategory = DB::table('subcategories')->where('id', $id)->first(); // return data as object 
        return view('backend.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function store(StoreSubcategoryRequest $request)
    {
        $photoName = $this->uploadPhoto($request->image, 'subcategories');
        $data = $request->except('_token', 'image', 'page');
        $data['image'] = $photoName;
        DB::table('subcategories')->insert($data);
        return $this->redirectAccordingToRequest($request);
    }

    public function update(UpdateSubcategoryRequest $request, $id)
    {
        $data = $request->except('_token', '_method', 'page', 'image');
        if ($request->has('image')) {
            $oldPhotoName = DB::table('subcategories')->select('image')->where('id', $id)->first()->image;
            $photoPath = public_path('/dist/img/subcategories/') . $oldPhotoName;
            $this->deletePhoto($photoPath);
            $photoName = $this->uploadPhoto($request->image, 'subcategories');
            $data['image'] = $photoName;
        }
        DB::table('subcategories')->where('id', $id)->update($data);
        return $this->redirectAccordingToRequest($request);
    }

    public function destroy($id)
    {
        $oldPhotoName = DB::table('subcategories')->select('image')->where('id', $id)->first()->image;
        $photoPath = public_path('/dist/img/subcategories/') . $oldPhotoName;
        $this->deletePhoto($photoPath);
        DB::table('subcategories')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Subcategory has been deleted successfully');
    }

    private function redirectAccordingToRequest($request)
    {
        if ($request->page == 'back') {
            return redirect()->back()->with('success', 'Subcategory has been updated successfully');
        } else {
            return redirect()->route('subcategories.index')->with('success', 'Subcategory has been updated successfully');
        }
    }
}
