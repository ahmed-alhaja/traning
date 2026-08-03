<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function destroy(ProductImage $img)
    {
        // $Count_img = ProductImage::where('product_id', $img->product_id)->count();

        // if ($Count_img <= 1) {
        //     return redirect()->back()->with('fail', 'لا تستطيع حذف اخر صورة');
        // }

        ProductImage::removeImage($img);
        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
