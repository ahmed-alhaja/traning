<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[ObservedBy(ProductObserver::class)]
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'long_description',
        'short_description',
        'parent_id',
    ];

    // Define any relationships if needed
    // For example, if a product belongs to a category:
    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }
    public function firstImage()
    {
        return $this->hasOne(ProductImage::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    public function notChanges()
    {
        $oldData = $this->only('title', 'short_description', 'long_description');
        $newData = request()->except('_token', '_method');
        return $newData === $oldData;
    }
}
