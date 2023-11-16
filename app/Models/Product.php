<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = ['brand_category_id', 'name', 'slug', 'price', 'quantity', 'specs', 'description', 'status'];

    public function category()
    {
        return $this->hasOneThrough(Category::class, BrandCategory::class, 'id', 'id', 'brand_category_id', 'category_id');
    }

    public function brand()
    {
        return $this->hasOneThrough(Brand::class, BrandCategory::class, 'id', 'id', 'brand_category_id', 'brand_id');
    }

    public function brandCategory()
    {
        return $this->hasOne(BrandCategory::class, 'id', 'brand_category_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }
}
