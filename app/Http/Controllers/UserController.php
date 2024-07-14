<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    public function LoginOrRegiter(){
        return view('Clients.account.signin');
    }
    public function profile(){
        return view('Clients.account.profile');
    }
    public function orderlist(){
        return view('Clients.account.order');
    }
    public function repass(){
        return view('Clients.account.repass');
    }
    public function help(){
        return view('Clients.account.help');
    }
  
}