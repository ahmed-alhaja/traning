<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $fillable = ['name', 'image', 'parent_id'];
    public $childrenNames = '';

    // public function getRouteKeyName(): string
    // {
    //     return 'name';
    // }


    public function image(): Attribute
    {
        return Attribute::make(
            set: fn($image) => $image->store("categoryImage", 'public'),
            get: fn($image) => asset("storage/$image")
        );
    }
    public function parent()
    {
        return $this->belongsTo($this::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany($this::class, 'parent_id');
    }
    public function products()
    {
         return $this->belongsToMany(Product::class);
    }
    public function allChildrenNames(): Attribute
    {
        return Attribute::make(
            get: function () {
                $this->concatAllCatNames($this);
                return $this->childrenNames;
            }
        );
    }

    public function concatAllCatNames($category)
    {
        foreach ($category->children as $child) {
            $this->childrenNames .= $child->name . ', ';
            $this->concatAllCatNames($child);
        }
    }

    public function deleteImageStorage($model)
    {
        $categoryDisk = Storage::disk('public');
        $oldImagePath = $model->getRawOriginal('image');
        if ($oldImagePath && $categoryDisk->exists($oldImagePath)) {
            $categoryDisk->delete($oldImagePath);
        }
    }
}
