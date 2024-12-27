<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login()
    {
        return view("auth.login");
    }

    function loginPost(Request $request)
    {
        $request->validate([
            'email' => "required",
            'password' => "required",
        ]);
        $credentials = $request->only("email", "password");         // lấy thông tin
        if(Auth::guard('customer')->attempt($credentials))          //kiểm tra thông tin
        {
            return redirect()->route("home");
        }
        return redirect(route("customer.login"))
            ->with("error", "Email hoặc mật khẩu không hợp lệ");
    }

    function register()
    {
        return view("auth.register");
    }

    function registerPost(Request $request)
    {
        $request->validate([
            "fullname" => "required",
            "email" => "required",
            "password" => "required|min:6|max:10|confirmed",
            "phone" => "required|regex:/^[0-9]{10}$/",
        ], [
            "fullname.required" => "Họ và tên là bắt buộc.",
            "email.required" => "Email là bắt buộc.",
            "email.email" => "Email không đúng định dạng.",
            "email.unique" => "Email này đã được sử dụng.",
            "password.required" => "Mật khẩu là bắt buộc.",
            "password.min" => "Mật khẩu phải có ít nhất 6-10 chữ số.",
            "password.confirmed" => "Mật khẩu xác nhận không khớp.",
            "phone.required" => "Số điện thoại là bắt buộc.",
            "phone.regex" => "Số điện thoại không hợp lệ.",
        ]);

        try {
            $user = new Customer();
            $user->name = $request->fullname; // gán gtrị ng dùng        
            $user->email = $request->email;       
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->save();        

            return redirect(route("customer.login"))
                ->with("success", "Tạo tài khoản thành công");
            
        }catch (\Illuminate\Database\QueryException $exception) {
            if ($exception->errorInfo[1] == 1062) { // Mã lỗi 1062: Duplicate entry
                return redirect()->back()->with('error', 'Email này đã được sử dụng.');
            }
            throw $exception;
        }
    }

    public function signOut()
    {
        Auth::guard('customer')->logout();

        return redirect()->route('home');
    }
}
