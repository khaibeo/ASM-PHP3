<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(){
        return view('Clients.home.index');
    }
    public function about(){
        return view('Clients.home.about');
    }
    public function contact(){
        return view('Clients.home.contact');
    }
    public function blog(){
        return view('Clients.home.blog');
    }
}