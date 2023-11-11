<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = "brands";

    protected $fillable = ['name', 'slug', 'avatar', 'status'];

    public function products()
    {
        return $this->hasManyThrough(Product::class, BrandCategory::class, 'brand_id', 'brand_category_id', 'id', 'id');
    }
}
