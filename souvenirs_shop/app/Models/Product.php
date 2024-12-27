<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'content',
        'menu_id',
        'price',
        'Soluong',
        'active',
        'thumb'
    ];

    public function menu()
    {
        return $this->hasOne(Menu::class, 'id', 'menu_id')
            ->withDefault(['name' => '']);
    }

    public function carts() {
        return $this->belongsToMany(Cart::class, 'carts_detail', 'product_id', 'cart_id')
                    ->withPivot('soluong')
                    ->withTimestamps();
    }

    public function cartDetails()
    {
        return $this->hasMany(CartDetail:: class, 'product_id');
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'orders_detail', 'product_id', 'order_id')
                    ->withPivot('soluong')
                    ->withPivot('price')
                    ->withTimestamps();
    }
}
