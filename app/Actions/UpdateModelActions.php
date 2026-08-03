<?php

namespace App\Actions;

use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UpdateModelActions
{
    public function handleUpdate(ProductRequest $request, Model $model)
    {
        $fields = array_keys($request->rules());
        $data = $request->only($fields);


        // صورة جديدة؟
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة لو موجودة
            if ($model->image && Storage::disk('public')->exists('products/' . $model->image)) {
                Storage::disk('public')->delete('products/' . $model->image);
            }


            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $realImage = $image->storeAs('products', $imageName, 'public');

            $data['image'] = $imageName;
        } else {
            unset($data['image']);
        }

        $original = $model->only($fields);

        if ($data === $original) {
            return ['status' => 'no_changes'];
        }

        $model->update($data);
        return ['status' => 'Updated', 'model' => $model];
    }
}
