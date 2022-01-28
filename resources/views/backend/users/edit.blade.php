

@extends('backend.layouts.parent')

@section('title', 'Edit Subcategory')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('backend.includes.message')
        </div>
        <div class="col-12">
            <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $user->name}}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="Status">Status</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{ $user->status == 1 ? 'selected' : '' }} value="1">Verified</option>
                            <option {{ $user->status == 2 ? 'selected' : '' }} value="2">Blocked</option>
                            <option {{ $user->status == 0 ? 'selected' : '' }} value="0">Not Verified</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-row my-3">
                        <div class="col-6">
                            <button class="btn btn-warning btn-sm" name="page" value="index"> Update </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-dark btn-sm" name="page" value="back"> Update & Return </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
