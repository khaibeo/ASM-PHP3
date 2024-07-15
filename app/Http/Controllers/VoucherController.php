<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function list(){
        return view('Clients.voucher.list-voucher');
    }
}
