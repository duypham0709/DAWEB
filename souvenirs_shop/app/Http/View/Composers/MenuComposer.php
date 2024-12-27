<?php
 
namespace App\Http\View\Composers;
 
use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Models\Menu;
 
class MenuComposer
{
    protected $users;

    public function __construct()
    {

    }
 
    public function compose(View $view)
    {
        $menus = Menu::select('id', 'name', 'parent_id')->where('active', 1)->orderByDesc('id')->get();
        // Truyền data ra ngoài view, 'menus' là biến view sẽ nhận
        $view->with('menus', $menus);
        // Lấy all data $menus truyền ra biến $view
        // Lấy biến menus để nhận toàn bộ thông tin từ $menus
    }
}