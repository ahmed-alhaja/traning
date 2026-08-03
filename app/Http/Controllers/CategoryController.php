<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with(['parent', 'children'])->paginate();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->image;
        }
        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'تم إنشاء قسم بنجاح');
    }

    /** 
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products;
        return view('categories.show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::get();
        return view('categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data =  $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->image;
            $category->deleteImageStorage($category);
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'تم تعديل القسم بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $category->deleteImageStorage($category);

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'تم حذف القسم بنجاح');
    }
}
