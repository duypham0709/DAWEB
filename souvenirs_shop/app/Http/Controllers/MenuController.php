<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;


class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index(Request $request, $id)
    {
        $menu = $this->menuService->getId($id);

        $query = $this->menuService->getProduct($menu, $request);

        $products = $query->paginate(20);

        return view('menu', [
            'title' => $menu->name,
            'products' => $products,
            'menu' => $menu,
        ]);
    }
}
