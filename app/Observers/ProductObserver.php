<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    public function saved(Product $product)
    {
        $request = request();
        if ($request->hasFile('images')) {
            $this->appendImages($product, $request->images);
        }
        $product->categories()->sync($request->categories);
    }

    public function deleted(Product $product)
    {
        ProductImage::removeImages($product);
    }

    public function appendImages($product, $images)
    {
        foreach ($images as $image) {
            $product->images()->create([
                'image' => $image
            ]);
        }
    }
}
