<?php
 
namespace App\Providers;
 
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\MenuComposer;
use App\Http\View\Composers\CartComposer;

//use Illuminate\View\View;
 
class ViewServiceProvider extends ServiceProvider
{

    public function register()
    {
        // ...
    }
 
    public function boot()
    {
        // Truyền thông tin menucomposer vào view này và vào header
        View::composer('header', MenuComposer::class);
        // View::composer('cart', CartComposer::class);
    }
}