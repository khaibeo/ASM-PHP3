<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class ProductController extends Controller
{
    public function index(){
        return view('Clients.product.product');
    }
    public function detail(){
        return view('Clients.product.product-detail');
    }
    public function review(){
        return view('Clients.product.review-product');
    }
}
