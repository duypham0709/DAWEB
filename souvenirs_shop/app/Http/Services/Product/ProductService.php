<?php


namespace App\Http\Services\Product;


use App\Models\Product;

class ProductService
{
    const LIMIT = 50;

    public function get($page = 0, $sort = null)
    {
        $query = Product::select('id', 'name', 'price', 'Soluong', 'thumb');

        // Kiểm tra điều kiện sắp xếp
        if ($sort === 'asc') {
            $query->orderBy('price', 'asc'); // Sắp xếp giá tăng dần
        } elseif ($sort === 'desc') {
            $query->orderBy('price', 'desc'); // Sắp xếp giá giảm dần
        } else {
            $query->orderByDesc('id'); // Mặc định sắp xếp theo ID giảm dần
        }

        // Phân trang sau khi sắp xếp
        return $query
            // ->offset($page * self::LIMIT)
            // ->limit(self::LIMIT)     
            ->get();
    }


    public function show($id)
    {
        return Product::where('id', $id)
            ->where('active', 1)
            ->with('menu')
            ->firstOrFail();
    }
}