<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showFormAuth(){
        return view('Clients.account.signin');
    }

    public function login(LoginRequest $request){
        $credentials = $request->except('_token');
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended();
        }
 
        return back()->withErrors([
            'email' => 'Tên đăng nhập hoặc mật khẩu không chính xác',
        ])->onlyInput('email');
    }
    
    public function register(RegisterRequest $request){
        $data = [
            'email' => $request->email_register,
            'password' => Hash::make($request->password_register),
            'name' => $request->name
        ];

        if($request->has('phone')){
            $data['phone'] = $request->phone;
        }

        if($request->has('address')){
            $data['address'] = $request->address;
        }

        $user = User::create($data);

        Auth::login($user);

        return redirect()->route('home.index');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}