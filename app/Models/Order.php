<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    protected $fillable = [
        'user_id',
        'name',
        'phone_number',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'pay_method',
        'pay_id',
        'pay_status',
        'ship_fee',
        'note',
        'status'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
