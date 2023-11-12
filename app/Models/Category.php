<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = ['name', 'slug', 'status'];

    public function banners(){
        return $this->hasMany(Banner::class,'category_id','id');
    }

    public function brandCategories(){
        $this->hasMany(BrandCategory::class,'category_id','id');
    }

    public function brands()
    {
        return $this->hasManyThrough(Brand::class, BrandCategory::class, 'category_id', 'id', 'id', 'brand_id');
    }
    public function products()
    {
        return $this->hasManyThrough(Product::class, BrandCategory::class, 'category_id', 'brand_category_id');
             // Để lấy các hình ảnh sản phẩm (nếu bạn muốn)
    }
    

}
