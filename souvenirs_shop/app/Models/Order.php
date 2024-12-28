<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $appends = ['totalPrice'];
    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'name',
        'phone',
        'address',
        'payment',
        'status'
    ];

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'orders_detail', 'order_id', 'product_id')
    //                 ->withPivot('soluong')
    //                 ->withPivot('price')
    //                 ->withTimestamps();
    // }

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function getTotalPriceAttribute()
    {
        $t = 0;
        foreach($this->details as $item)
        {
            $t += $item->price * $item->soluong;
        }
        return $t;
    }
}
