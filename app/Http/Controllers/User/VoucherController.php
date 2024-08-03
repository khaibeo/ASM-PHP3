<?php

namespace App\Http\Controllers\User;

use App\Models\Voucher;
use App\Models\VouchersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoucherController extends Controller
{
    public function list(){
        $data['vouchers'] = Voucher::getAllClient();
        return view('Clients.voucher.list-voucher', $data);
    } 
}
