<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;
    
    protected $table = 'orders_detail';

    protected $fillable = [
        'order_id',
        'product_id',
        'soluong',
        'price'
    ];

    public function orders() {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function products() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
