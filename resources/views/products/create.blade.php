@extends('layouts.dashboard')
@section('title', 'Create Product')
@section('content')
    <form class="max-w-sm mx-auto" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter name"
                value="{{ old('title') }}">
            @error('title')
                <span class="block text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">short_description</label>
            <input type="text" class="form-control" id="Short-disc" name="short_description"
                placeholder="Enter description" value="{{ old('short_description') }}">
            @error('short_description')
                <span class="block text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">long_description</label>
            <textarea type="text" class="form-control" id="Long-disc" name="long_description" placeholder="Enter description"
                rows="5">{{ old('long_description') }}</textarea>
            @error('long_description')
                <span class="block text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="categories">اختر تصنيفات المنتج</label>
            <select name="categories[]" id="categories" class="form-control" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('categories')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="images">صورة المنتج</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple value="{{ old('images') }}">
            @error('images')
                <span class="block text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create Product</button>
        </div>
    </form>
@endsection
