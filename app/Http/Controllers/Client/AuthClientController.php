<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Auth\LoginRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthClientController extends Controller
{
    public function index(){
        $user = auth()->user();
        // $countCart=Cart::where('user_id', $user->id)->count();
        return view('client.auth.login',[
            'title'=>'Đăng nhập',
            // 'countCart'=>$countCart

        ]);
    }
    public function saveLogin(LoginRequest $request){
        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ])){
            return redirect('/');
        }else{
        // session()->flash('errors', 'Tài khoản mật khẩu không chính xác');
            return redirect()->route('login')->withErrors([
                'email' => 'Tài khoản và mật khẩu không chính xác',
            ]);;
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('/');
    }

    public function register(){
        return view('client.auth.register',['title'=>'Đăng ký']);
    }
    public function saveRegister(Request $request){
        $user=new User();

        if($request->password == $request->enter_password){
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=bcrypt($request->password);
            $user->role_id=1;
            $user->avatar="";
            $user->number_phone="";
            $user->gender="";
            $user->save();
            return redirect()->back();
        }else{
            return redirect()->route('register')->withErrors([
                'password' => 'Mật khẩu không trùng khớp',
            ]);
        }
    }
}
