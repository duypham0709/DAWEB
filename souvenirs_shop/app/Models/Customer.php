<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $guard = 'customer';
    protected $table = 'customers';

    // Các cột có thể lưu vào cơ sở dữ liệu
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
    ];

    // Ẩn các thuộc tính không muốn hiển thị (ví dụ: mật khẩu)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
    
    public function carts()
    {
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
}
