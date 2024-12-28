<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CartService;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect(route('customer.login'));
        }

        $result = $this->cartService->create($request);
        if ($result == false) {
            return redirect()->back();
        }
        if ($request->input('action') === 'buy_now') {
            return redirect('/carts');
        }
        return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
    }

    public function show()
    {
        $cart = Cart::where('customer_id', Auth::guard('customer')->id())->first();
        $products = $this->cartService->getProduct();

        return view('carts.list', [
            'title' => 'Giỏ hàng',
            'products' => $products,
            'cart' => $cart
        ]);
    }

    public function remove($id = 0)
    {
        $this->cartService->remove($id);
        return redirect('/carts')->with('success', 'Xoá thành công');
    }

    public function update(Request $request)
    {
        $cart = Cart::where('customer_id', Auth::guard('customer')->id())->first();

        if (!$cart) {
            return redirect('/carts')->with('error', 'Giỏ hàng không tồn tại');
        }

        $productQty = $request->input('num_product');

        if (empty($productQty)) {
            return redirect('/carts')->with('error', 'Không có sản phẩm để cập nhật');
        }

        foreach ($productQty as $productId => $quantity) {
            // Kiểm tra nếu số lượng không hợp lệ
            if ($quantity <= 0) {
                continue; // Bỏ qua nếu số lượng <= 0
            }

            $cart->products()->updateExistingPivot($productId, ['soluong' => $quantity]);
        }

        return redirect('/carts')->with('success', 'Giỏ hàng đã được cập nhật');
    }

}
