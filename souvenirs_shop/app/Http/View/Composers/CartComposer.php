<?php
 
namespace App\Http\View\Composers;

use App\Models\Cart;
use App\Repositories\UserRepository;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

 
class CartComposer
{
    // protected $users;

    public function __construct() {}

    // public function compose(View $view)
    // {
    //     $customerId = Auth::guard('customer')->id();
    //     $cart = Cart::where('customer_id', $customerId)->first();

    //     if (!$cart) {
    //         $view->with('products', collect());
    //         return;
    //     }

    //     $products = Product::join('carts_detail', 'products.id', '=', 'carts_detail.product_id')
    //         ->where('carts_detail.cart_id', $cart->id)
    //         ->select('products.id', 'products.name', 'products.price', 'products.thumb', 'carts_detail.soluong')
    //         ->get();

    //     $view->with('products', $products);
    // }
 
    // public function compose(View $view)
    // {
    //     $carts = Session::get('carts', []);
    //     if(empty($carts)){
    //         $view->with('products', collect());
    //         return;
    //     }

    //     $productId = array_keys($carts);
    //     $products = Product::select('id', 'name', 'price', 'thumb')
    //         ->where('active', 1)
    //         ->whereIn('id', $productId)
    //         ->get(); 

    //     $view->with('products', $products);

    //     foreach ($products as $product) {
    //         $product->soluong = $carts[$product->id]; // Gắn số lượng từ session
    //     }
        
    //     return $products;
    // }
}