<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\CartService;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;


class OrderController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function checkout()
    {
        $cart = Cart::where('customer_id', Auth::guard('customer')->id())->first();
        $products = $this->cartService->getProduct();
        $customer = Auth::guard('customer')->user();
        return view('carts.checkout', [
            'title' => 'Place order',
            'products' => $products,
            'cart' => $cart,
            'customer' => $customer
        ]);
    }
    public function history()
    {
        $customer = Auth::guard('customer')->user();
        return view('carts.history', [
            'title' => 'Đơn mua',
            'customer' => $customer
        ]);
    }
    public function detail(Order $order)
    {
        $customer = Auth::guard('customer')->user();
        return view('carts.detail', [
            'title' => 'Thông tin sản phẩm',
            'customer' => $customer,
            'order' => $order
        ]);
    }

    public function checkoutPost(Request $request)
    {
        // Kiểm tra nếu user đang đăng nhập
        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user();

            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'payment' => 'required'
            ], [
                "name.required" => "Vui lòng nhập tên.",
                "phone.required" => "Vui lòng nhập số điện thoại.",
                "address.required" => "Vui lòng nhập địa chỉ.",
                "payment.required" => "Chọn phương thức thanh toán.",
            ]);

            // Hiển thị thông tin để kiểm tra
            $data = $request->only('name', 'email', 'phone', 'address', 'payment');
            $data['customer_id'] = $customer->id;

            if($order = Order::create($data))
            {
                // Truy xuất các sản phẩm trong giỏ hàng của khách hàng từ bảng carts_detail
                $cartDetails = CartDetail::whereHas('carts', function ($query) use ($data) {
                    $query->where('customer_id', $data['customer_id']);
                })->get();

                // Lặp qua từng sản phẩm trong giỏ hàng
                foreach ($cartDetails as $cartDetail) {
                    // Lấy giá sản phẩm từ bảng products
                    $product = Product::find($cartDetail->product_id);

                    if (!$product) {
                        // Nếu sản phẩm không tồn tại, bỏ qua sản phẩm này
                        continue;
                    }

                    $data1 = [
                        'order_id' => $order->id, // ID của đơn hàng vừa tạo
                        'product_id' => $cartDetail->product_id, // ID sản phẩm từ giỏ hàng
                        'soluong' => $cartDetail->soluong, // Số lượng sản phẩm trong giỏ hàng
                        'price' => $product->price, // Giá sản phẩm từ bảng products
                    ];

                    OrderDetail::create($data1);
                }

                // Xóa toàn bộ thông tin sau khi đã lưu
                CartDetail::whereHas('carts', function ($query) use ($data) {
                    $query->where('customer_id', $data['customer_id']);
                })->delete();

                return redirect()->back()->with('success', 'Đơn hàng đã được lưu.');
            }
        }
        return redirect()->back()->with('error', 'Vui lòng đăng nhập để đặt hàng.');
    }
}
