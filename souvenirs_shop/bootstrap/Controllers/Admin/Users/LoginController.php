<?php

namespace App\Http\Controllers\Admin\Users;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.users.login', [
            'title' => 'Bảng nhập hệ thống',
            'name' => 'LOGIN ADMIN'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);
        if (
            Auth::guard('admin')->attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ], $request->input('remember'))
        ) {
            return redirect()->route('admin.index');
        }
        session()->flash('error', 'Email hoặc password không hợp lệ');
        return redirect()->back();
    }

    public function logOut()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}