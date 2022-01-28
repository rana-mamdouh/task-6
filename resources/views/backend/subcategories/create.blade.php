@extends('backend.layouts.parent')

@section('title', 'Create Subcategory')

@section('content')
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @include('backend.includes.message')
        <div class="col-12">
            <form action="{{ route('subcategories.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-6">
                        <label for="name_en">Name EN</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{old('name_en')}}">
                    </div>
                    <div class="col-6">
                        <label for="name_ar">Name AR</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{old('name_ar')}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="Status">Status</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{old('status') == 1 ? 'selected':''}} value="1">Active</option>
                            <option {{old('status') == 0 ? 'selected':''}}  value="0">Not Active</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="category_id">Categories</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option {{old('category_id') == $category->id ? 'selected':''}}  value="{{$category->id}}">{{$category->name_en}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>
                <div class="form-row my-3">
                    <div class="col-4">
                        <button class="btn btn-primary" name="page" value="index"> Create </button>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-dark" name="page" value="back"> Create & return </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
