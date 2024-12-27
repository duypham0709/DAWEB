<?php

namespace App\Providers;

use App\Http\Services\CartService;
use App\Models\Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cartCount = 0;

            // Lấy customer hiện tại
            if (Auth::guard('customer')->check()) {
                $customer = Auth::guard('customer')->user();

                // Đếm tổng số lượng sản phẩm trong giỏ hàng
                $cartItems = Cart::where('customer_id', $customer->id)
                    ->with('cartDetails')
                    ->get();
                foreach ($cartItems as $cartItem) {
                    foreach ($cartItem->cartDetails as $detail) {
                        $cartCount += $detail->soluong; // Cộng dồn số lượng
                    }
                }
            }

            $view->with('cartCount', $cartCount);
        });
    }
}
