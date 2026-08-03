<?php

namespace App\Actions;

use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Model;

class CreateModelActions
{

    public function handleCreate(ProductRequest $request , Model $model)
    {
        $data = $request->validated();
        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->extension();
        $image->storeAs('products', $imageName, 'public');
        // Storage::putFileAs('public/products', $image, $imageName);
        // $image->storeAs('public/products', $imageName);
        $data['image'] = $imageName;
        $model->create($data);
    }
}
