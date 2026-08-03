@extends('layouts.dashboard')
@section('title', 'Edit Product')
@section('content')
    <form class="max-w-sm mx-auto" method="POST" action="{{ route('products.update', $product->id) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter name"
                value="{{ $product->title }}">
            @error('title')
                <span class="block text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">short_description</label>
            <input type="text" class="form-control" id="Short-disc" name="short_description"
                placeholder="Enter description" value="{{ $product->short_description }}">
            @error('short_description')
                <span class="block text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">long_description</label>
            <textarea type="text" class="form-control" id="Long-disc" name="long_description" placeholder="Enter description"
                rows="5">{{ $product->long_description }}</textarea>
            @error('long_description')
                <span class="block text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="images">صورة المنتج</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple
                value="{{ $product->images }}">
            @error('images')
                <span class="block text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
