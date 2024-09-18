<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PaymentController extends Controller
{
    public function vnpayPayment()
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('payment.check');
        $vnp_TmnCode = "MKRJ5MYP"; //Mã website tại VNPAY 
        $vnp_HashSecret = "IYHZWTIATFASKCGVRBOJEKDCKHANXEOO"; //Chuỗi bí mật

        $vnp_TxnRef = '#' . session('orderId');
        $vnp_OrderInfo = 'Thanh toán đơn hàng #' . session('orderId');
        $vnp_OrderType = 'Shop quần áo';
        $vnp_Amount = session('total') * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (session('redirect')) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function checkPayment(Request $request)
    {
        $vnp_SecureHash = $request->vnp_SecureHash;
        $vnp_HashSecret = "IYHZWTIATFASKCGVRBOJEKDCKHANXEOO";
        $inputData = array();
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $orderId = trim($request->vnp_TxnRef,'#');

        if ($secureHash == $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                $order = Order::query()->find($orderId);

                $order->update([
                    'order_status' => 'processing'
                ]);

                //Gửi mail
                Notification::route('mail', $order->email)->notify(new OrderNotification($order));

                return redirect()->route('checkout.success', $orderId);
            }
        }

        return redirect()->route('payment.fail', $orderId);
    }

    public function showError($id){
        return view('Clients.checkout.fail', compact('id'));
    }

    public function changePaymentMethod($id)
    {
        Order::query()->find($id)->update(['payment_method' => 0, 'order_status' => 'pending']);

        return redirect()->route('checkout.success', $id);
    }
}
