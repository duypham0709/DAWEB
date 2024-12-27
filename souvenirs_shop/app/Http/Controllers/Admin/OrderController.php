<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index() {
        $status = request('status', 0);
        $orders = Order::orderBy('id', 'DESC')->where('status', $status)->paginate();
        return view('admin.order.index', [
            'title' => 'Danh sách đơn hàng',
            'orders' => $orders
        ]);
    }

    public function show(Order $order) {
        return view('admin.order.detail', [
            'title' => 'Chi tiết đơn hàng',
            'order' =>$order
        ]);
    }
}
