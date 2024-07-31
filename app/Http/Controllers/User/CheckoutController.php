<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Voucher;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())->with('items')->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $cartItems = $cart->items()->with(['variant.product','variant.attributeValues.attribute'])->get();

        $cartItems = $cartItems->map(function ($item) {
            $variantAttributes = $item->variant->attributeValues->map(function ($av) {
                return $av->attribute->name . ': ' . $av->value;
            })->implode(', ');

            $item->variantAttributes = $variantAttributes;
            return $item;
        });

        $user = auth()->user();
        
        $total = $this->calculateCartTotal($cart);
        
        return view('Clients.checkout.index', compact('cartItems', 'total','user'));
    }

    public function process(CheckoutRequest $request)
    {
        DB::beginTransaction();

        try {
            $cart = Cart::where('user_id', auth()->id())->with('items.variant.product')->firstOrFail();

            $defaultStatus = $request->payment_method == 1 ? 'unpaid' : 'pending';
            
            $order = Order::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'note' => $request->note,
                'payment_method' => $request->payment_method,
                'order_status' => $defaultStatus,
                'total_product_price' => $request->totalProduct,
                'discount_amount' => $request->discountedValue ?? 0,
                'total_amount' => $request->totalbill,
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $item->variant->id,
                    'quantity' => $item->quantity,
                    'product_name' => $item->variant->product->name,
                    'product_sku' => $item->variant->product->sku,
                    'product_sale_price' => $item->variant->sale_price,
                    'product_regular_price' => $item->variant->regular_price,
                ]);

                // Giảm số lượng sản phẩm của biến thể
                $item->variant->decrement('stock', $item->quantity);
            }

            // Xóa sản phẩm khỏi giỏ sau khi đặt hàng thành công
            $cart->items()->delete();

            if($request->voucher){
                Voucher::query()->find($request->voucher)->decrement('quantity',1);
            }

            DB::commit();

            if($request->payment_method == 1){
                Session::put('total', $request->totalbill);
                Session::put('orderId', $order->id);
                Session::put('redirect', true);

                return redirect()->route('payment');
            }

            //Gửi mail
            Notification::route('mail', $request->email)->notify(new OrderNotification($order));

            return redirect()->route('checkout.success', ['order' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
           // dd($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra trong quá trình đặt hàng. Vui lòng thử lại.');
        }
    }

    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('Clients.checkout.success', compact('order'));
    }

    private function calculateCartTotal($cart)
    {
        return $cart->items->sum(function ($item) {
            $price = $item->variant->sale_price ?? $item->variant->regular_price;
            return $item->quantity * $price;
        });
    }

    public function checkVoucher(Request $request)
    {
        $code = $request->input('code');
        $total = $request->input('total');

        $voucher = Voucher::where('code', $code)->first();

        if (!$voucher) {
            return response()->json([
                'valid' => false,
                'message' => 'Mã giảm giá không tồn tại.'
            ]);
        }

        if ($voucher->quantity <= 0) {
            return response()->json([
                'valid' => false,
                'message' => 'Mã giảm giá đã hết lượt sử dụng.'
            ]);
        }

        if (Carbon::now()->isAfter($voucher->valid_until)) {
            return response()->json([
                'valid' => false,
                'message' => 'Mã giảm giá đã hết hạn.'
            ]);
        }

        $discountValue = $voucher->discount_type == '1'
            ? $total * ($voucher->discount_value / 100)
            : $voucher->discount_value;

        // Kiểm tra giá trị giảm tối đa nếu có
        // if ($voucher->max_discount && $discountValue > $voucher->max_discount) {
        //     $discountValue = $voucher->max_discount;
        // }

        // Kiểm tra giá trị đơn hàng tối thiểu
        // if ($voucher->min_order_value && $total < $voucher->min_order_value) {
        //     return response()->json([
        //         'valid' => false,
        //         'message' => "Giá trị đơn hàng tối thiểu để sử dụng mã này là " . number_format($voucher->min_order_value) . ' đ'
        //     ]);
        // }

        return response()->json([
            'valid' => true,
            'discount_type' => $voucher->discount_type,
            'discount_value' => $discountValue,
            'id' => $voucher->id,
            'message' => 'Mã giảm giá hợp lệ.'
        ]);
    }
}
