<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Client\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showFormLogin(){
        return view('admin.auth.signin');
    }

    public function login(LoginRequest $request){
        $credentials = $request->except('_token');

        $user = Auth::attempt($credentials);
 
        if ($user) {
            $request->session()->regenerate();
 
            return redirect()->route('admin.dashboard');
        }
 
        return back()->withErrors([
            'email' => 'Tên đăng nhập hoặc mật khẩu không chính xác',
        ]);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('auth.admin.login');
    }
}