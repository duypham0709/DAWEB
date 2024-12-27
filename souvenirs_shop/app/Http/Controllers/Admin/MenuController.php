<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function create()
    {
        return view('admin.menu.add', [
            'title' => 'Thêm danh mục mới',
            'name' => 'Thêm sản phẩm',
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function createt($request)
    {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (string) $request->input('parent_id'),
                'active' => (string) $request->input('active'),
                // 'slug' => Str::slug($request->input('name'), '-')
            ]);
            Session::flash('success', 'Tạo danh mục thành công');
        } catch (Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function store(CreateFormRequest $request)
    {
            $this->createt($request);

        return redirect()->back();
    }

    public function index()
    {
        return view('admin.menu.list', [
            'title' => 'Danh sách danh mục mới nhất.',
            'menu' => $this->menuService->getAll()
        ]);
    }

    public function show(Menu $menu)
    {
        return view('admin.menu.edit', [
            'title' => 'Chỉnh sửa Danh mục: ' . $menu->name,
            'menu' => $menu,
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function update(Menu $menu, CreateFormRequest $request)
    {
        $this->menuService->update($request, $menu);

        return redirect('/admin/menus/list');
    }

    public function destroy(Request $request)
    {
        $result = $this->menuService->destroy($request);
        if($result)
        {
            return response()->json([
                'error' => false,
                'message' => 'Xoá thành công danh mục'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }
}