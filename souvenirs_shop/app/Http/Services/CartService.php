<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartService
{
    // Hàm tạo giỏ hàng cho khách hàng
    public function create($request)
    {
        $customerId = Auth::guard('customer')->id(); // Lấy ID khách hàng đã đăng nhập
        $soluong = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');

        if ($soluong <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc sản phẩm không chính xác');
            return false;
        }

        // Kiểm tra xem khách hàng đã có giỏ hàng chưa
        $cart = Cart::where('customer_id', $customerId)->first();

        // Nếu khách hàng chưa có giỏ hàng, tạo giỏ hàng mới
        if (!$cart) {
            $cart = Cart::create(['customer_id' => $customerId]);
        }

        $cart->products()->syncWithoutDetaching([$product_id => ['soluong' => $soluong]]);
        
        return true;
    }

    // Lấy danh sách sản phẩm trong giỏ hàng của khách hàng
    public function getProduct()
    {
        $customerId = Auth::guard('customer')->id();
        $cart = Cart::where('customer_id', $customerId)->first(); // Lấy giỏ hàng của khách hàng

        if ($cart) {
            return $cart->products; // Trả về tất cả các sản phẩm trong giỏ hàng
        }
        
        return [];
    }

    public function remove($productId)
    {
        $customerId = Auth::guard('customer')->id(); // Lấy ID khách hàng đang đăng nhập

        $cart = Cart::where('customer_id', $customerId)->first();

        if ($cart) {
            // Xóa sản phẩm khỏi giỏ hàng
            $cart->products()->detach($productId);
            return true;
        }

        return false; // Không tìm thấy giỏ hàng
    }
}