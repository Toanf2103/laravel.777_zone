<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = "banners";

    protected $fillable = ['category_id', 'image', 'image_object_name', 'link', 'status'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
