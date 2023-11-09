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
        return $this->hasMany(Banners::class,'category_id','id');
    }

    public function brandCategories(){
        $this->hasMany(BrandCategory::class,'category_id','id');
    }

}
