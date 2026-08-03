@extends('layouts.dashboard')
@section('title', 'Create Categories')
@section('content')
    <form action="{{ route('categories.store') }}" class="max-w-sm mx-auto" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">الفئة</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <span class="block text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="parent_id">القسم الأب</label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="">-- اختر القسم الأب --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('parent_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">صورة القسم</label>
            <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create Category</button>
        </div>
    </form>
@endsection
