<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    
    protected $table = "order_details";

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    public function order(){
        return $this->hasOne(Order::class,'id','order_id');
    }

    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }

}
