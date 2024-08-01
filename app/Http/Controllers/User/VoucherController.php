<?php

namespace App\Http\Controllers\User;

use App\Models\Voucher;
use App\Models\VouchersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoucherController extends Controller
{
    public function list(){
        $data['vouchers'] = VouchersModel::getAllClient();
        return view('Clients.voucher.list-voucher', $data);
    }

    public function saveVoucher(Request $request, $id)
    {
        $voucher = VouchersModel::find($id);

        if ($voucher) {
            $voucher->save();

            // Trả về thông báo thành công
            return back()->with('success', 'Mã giảm giá đã được lưu thành công!');
        } else {
            return back()->with('error', 'Không tìm thấy mã giảm giá.');
        }
    }
    
}
