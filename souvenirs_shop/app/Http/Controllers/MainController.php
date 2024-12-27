<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Models\Product;


class MainController extends Controller
{
    protected $product;

    public function __construct(ProductService $product)
    {
        $this->product = $product;
    }
    public function index(Request $request)
    {   
        $sort = $request->input('price', null);
        $products = $this->product->get(0, $sort);
        return view('home', [
            'title' => 'Đồ lưu niệm',
            'products' => $products

        ]);

    }

    // public function loadProduct(Request $request) //truy vấn
    // {
    //     $page = $request->input('page', 0);

    //     $result = $this->product->get($page);       
    //     if(count($result) != 0) {
    //         // truyền vào view 1 biến là products và chứa data vào render
    //         $html = view('products.list', ['products' => $result])->render();
    //         return response()->json(['html' => $html ]);
    //     }
    //     return response()->json(['html' => '' ]);
    // }
}