<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Models\Menu;
use App\Models\Product;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index($id = '')
    {
         $product = $this->productService->show($id);
         return view('products.detail', [
            'title' => $product->name,
            'product' => $product
         ]);
    }

    public function search(Request $request)
    {
        $title = 'Kết quả tìm kiếm';
        $keyword = $request->input('search-product');
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                            ->paginate(20);

        return view('search', compact('title', 'products'));
    }
}
