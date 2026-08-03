<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image',
    ];

    public function image(): Attribute
    {
        return Attribute::make(
            set: fn($image) => $image->store("images/products", 'public'),
            get: fn($image) => asset("storage/$image"),
        );
    }
    public static function removeImage($image)
    {
        $publicDisk = Storage::disk('public');
        $imagePath = $image->getRawOriginal('image');
        // The old value of image that saved in database beacuse we use the attribute in model
        if ($publicDisk->exists($imagePath)) {
            $publicDisk->delete($imagePath);
        }
        $image->delete();
    }

    public static function removeImages(Product $product)
    {
        $images = self::where('product_id', $product->id)->get();
        foreach ($images as $image) {
            self::removeImage($image);
        }
    }
}
