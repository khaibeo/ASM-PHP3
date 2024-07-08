<?php

namespace App\Http\Controllers;

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
}
