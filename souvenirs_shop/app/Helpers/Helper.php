<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';
        
        foreach ($menus as $key => $menu){
            if ($menu->parent_id == $parent_id) {
                $html .= '<tr>
                    <td>' . $menu->id .'</td>
                    <td>' . $char . $menu->name .'</td>
                    <td>' . self::active($menu->active) .'</td>
                    <td>' . $menu->updated_at .'</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/menus/edit/'. $menu->id .'">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" 
                            onclick = "removeRow('. $menu->id .', \'/admin/menus/destroy\')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>';

                unset($menus[$key]);
                // $html .= self::menu($menus, $menu->id, $char .'--');
            }
        }
        return $html;
    }

    public static function active($active = 0)
    {
        return $active == 0 ? '<span>&#10060</span>' :
        '<span>&#9989</span>';
    }

    public static function menus($menus, $parent_id = 0)
    {
        $html ='';
        foreach ($menus as $menu) {
            // nếu biến $menu = mục cha
            if($menu->parent_id == $parent_id) {
                $html .='
                    <li class="nav__list-item hiden_tablet_mobile">
                        <a href="/danh-muc/' . $menu->id . '-'. Str::slug($menu->name, '-') .'.html">
                            '. $menu->name . '
                        </a>
                    </li>
                ';
            }
        }
        return $html;
    }

    public static function price($price = 0)
    {
        if($price != 0) {
            return number_format($price, 0, ',', ',') . 'đ';
        }
        return '<a>--</a>';
    }
    public static function soluong($soluong = 0)
    {
        if($soluong != 0) { 
            return $soluong;
        }
        return '<a>Hết hàng</a>';
    }
}