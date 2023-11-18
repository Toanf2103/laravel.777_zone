<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comments";

    protected $fillable = ['user_id', 'product_id', 'content', 'reply_id'];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function commentParent()
    {
        return $this->hasOne(Comment::class, 'id', 'reply_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'reply_id', 'id');
    }
}
