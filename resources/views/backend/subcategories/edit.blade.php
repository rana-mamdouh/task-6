@extends('backend.layouts.parent')

@section('title', 'Edit Subcategory')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('backend.includes.message')
        </div>
        <div class="col-12">
            <form action="{{ route('subcategories.update', $subcategory->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-6">
                        <label for="name_en">Name EN</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $subcategory->name_en }}">
                        @error('name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="name_ar">Name AR</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $subcategory->name_ar }}">
                        @error('name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="Status">Status</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{ $subcategory->status == 1 ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $subcategory->status == 0 ? 'selected' : '' }} value="0">Not Active</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="category_id">Categories</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option {{ $subcategory->category_id == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->name_en }}</option>
                            @endforeach
                        </select>
                        @error('subcategory_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <img src="{{ url('dist/img/Subcategories/' . $subcategory->image) }}" alt="{{ $subcategory->name_en }}"
                            class="w-100">
                    </div>
                </div>
                <div class="form-row my-3">
                    <div class="col-2">
                        <button class="btn btn-warning" name="page" value="index"> Update </button>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-dark " name="page" value="back"> Update & Return </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
