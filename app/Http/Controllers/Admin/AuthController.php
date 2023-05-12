<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('admin.auth.login',[
            'title'=>'Login'
        ]);
    }
    public function login(Request $request){
        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ])){
            return redirect('admin/home');
        }else{
            return redirect('admin/login')->withErrors([
                'email' => 'Tài khoản và mật khẩu không chính xác',
            ]);
        }
    }
}
