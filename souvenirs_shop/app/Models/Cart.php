<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';

    protected $fillable = [
        'customer_id', 
    ];

    // Quan hệ với bảng products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'carts_detail', 'cart_id', 'product_id')
                    ->withPivot('soluong') // Chỉ giữ cột số lượng
                    ->withTimestamps();
    }

    public function cartDetails(){
        return $this->hasMany(CartDetail::class, 'cart_id');
    }

    // Quan hệ với bảng customers
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
