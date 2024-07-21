<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class HomeController extends Controller
{
    public function index(){
        $categories = Catalogue::with('children')->whereNull('parent_id')->get();
        return view('Clients.home.index',compact('categories'));
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
    public function getCataloues(){

    }
}