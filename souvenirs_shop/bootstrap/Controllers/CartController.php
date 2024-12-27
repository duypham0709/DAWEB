<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CartService;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        $result = $this->cartService->create($request);
        if($result === false)
        {
            return redirect()->back();
        }
        if($request->input('action') === 'buy_now')
        {
            return redirect('/carts');
        }
        return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
    }

    public function show()
    {
        $products = $this->cartService->getProduct();

        return view('carts.list', [
            'title' => 'Giỏ hàng',
            'products' => $products,
            'carts'=> Session::get('carts')
        ]);
    }

    public function remove($id = 0)
    {
        $this->cartService->remove($id);
        return redirect('/carts');
    }

    public function update(Request $request)
    {
        $this->cartService->update($request);
        return redirect('/carts');
    }
}
