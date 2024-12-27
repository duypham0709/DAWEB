<?php
namespace App\Http\Services\Menu;


use Illuminate\Support\Str;
use App\Models\Menu;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Controllers\Admin\MenuController;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Exists;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    // public function show()
    // {
    //     return Menu::select('name', 'id')
    //         ->where('parent_id' , 0)
    //         ->orderbyAsc('id')
    //         ->get();
    // }

    public function getAll()
    {
        return Menu::orderby('id', 'ASC')->paginate(10);
    }

    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (string) $request->input('parent_id'),
                'active' => (string) $request->input('active'),
            ]);
            Session::flash('success', 'Tạo danh mục thành công');
        } catch (Exception $err) {
            Session::flash('error', 'Có lỗi xảy ra, vui lòng thử lại');
            Log::error($err->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $menu) : bool
    {
        if($request->input('parent_id') != $menu->id) {
            $menu->parent_id = (int) $request->input('parent_id');
        }
        
        $menu->name = (string) $request->input('name');
        $menu->active = (string) $request->input('active');
        $menu->save();

        Session::flash('success', 'Cập nhật thành công Danh mục.');
        return true;
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');

        $menu = Menu::where('id', $id)->first();
        if($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    public function getId($id)
    {
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProduct($menu, $request)
    {
        $query = $menu->products()
            ->select('id', 'name', 'price', 'Soluong', 'thumb')
            ->where('active', 1);
        
        if($request->input('price')) {
            $query->orderBy('price', $request->input('price'));
        }

        return $query->orderByDesc('id');
    }
}