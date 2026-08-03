@extends('layouts.dashboard')
@section('title', 'Edit Categories')

@section('content')
@section('content')
    <form class="max-w-sm mx-auto" method="POST" action="{{ route('categories.update', $category->id) }}"
        enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" class="form-control" id="title" name="name" placeholder="Enter name"
                value="{{ $category->name }}">
            @error('name')
                <span class="block text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="parent_id">القسم الأب</label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="">-- اختر القسم الأب --</option>
                @foreach ($categories as $parent)
                    <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
            @error('parent_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">صورة القسم</label>
            <input type="file" name="image" id="image" class="form-control">
            <div>
                <img src="{{ $category->image }}" alt="image" width=100">
            </div>
            @error('image')
                <span class="block text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
