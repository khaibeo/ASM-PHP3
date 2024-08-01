<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function LoginOrRegiter()
    {
        return view('Clients.account.signin');
    }
    public function profile()
    {
        $user = Auth::user();
        return view('Clients.account.profile', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validate dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => ['required', 'regex:/^(\+84|0[3|5|7|8|9])+([0-9]{8})$/'], // Sử dụng regex để validate số điện thoại
            'address' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate ảnh
        ],
        [
            'name.required' => 'trường này không bỏ trống',
            'name.string' => 'bạn phải nhập văn bản',
            'name.max' => 'văn bản không được vượt quá 255 ký tự',
            
            'email.required' => 'trường này không bỏ trống',
            'email.string' => 'bạn phải nhập văn bản',
            'email.email' => 'bạn phải nhập một địa chỉ email hợp lệ',
            'email.max' => 'email không được vượt quá 255 ký tự',
            'email.unique' => 'email này đã được sử dụng',
        
            'phone.required' => 'trường này không bỏ trống',
            'phone.regex' => 'bạn phải nhập một số điện thoại hợp lệ',
        
            'address.required' => 'trường này không bỏ trống',
            'address.string' => 'bạn phải nhập văn bản',
            'address.max' => 'địa chỉ không được vượt quá 255 ký tự',
        
            'thumbnail.image' => 'tệp phải là một hình ảnh',
            'thumbnail.mimes' => 'ảnh phải có định dạng jpeg, png, jpg, gif, hoặc svg',
            'thumbnail.max' => 'ảnh không được vượt quá 2048 kilobytes',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cập nhật thông tin người dùng
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        // Xử lý upload ảnh
        if ($request->hasFile('thumbnail')) {
            // Kiểm tra xem người dùng đã có ảnh chưa
            if ($user->thumbnail) {
                Storage::delete('public/' . $user->thumbnail);
            }

            // Lưu ảnh mới
            $path = $request->file('thumbnail')->store('profile_pictures', 'public');
            $user->thumbnail = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Thông tin cá nhân đã được cập nhật thành công!');
    }
    public function orderlist()
    {
        
        $user = Auth::user();
        $user_orders = Order::where('user_id', $user->id)
        ->orderByRaw("FIELD(order_status, 'shipped', 'processing', 'pending', 'unpaid', 'delivered', 'cancelled')")
        ->orderBy('created_at', 'desc')
        ->get();
       
        $orders = $user_orders->sortBy(function ($order) {
            $statusOrder = [
                'shipped' => 1,
                'processing' => 2,
                'pending' => 3,
                'unpaid' => 4,
                'delivered' => 5,
                'cancelled' => 6
            ];
            
            return $statusOrder[$order->order_status] ?? 999; 
        });
        $orders = $user_orders->map(function ($order) {
            $order_details = OrderDetail::where('order_id', $order->id)->get();
            $order->total = number_format($order->total, 0, ',', '.') . ' đ';


            $order->details = $order_details->map(function ($detail) {
                $detail->price = number_format($detail->price, 0, ',', '.');
                $detail->subtotal = number_format($detail->subtotal, 0, ',', '.');
                return $detail;
            });

            return $order;
        });
        //dd($orders);
        return view('Clients.account.order', compact('orders', 'user'));
    }
    public function showOrderDetail($id)
    {
        $order = Order::query()->find($id);
        $orderItems = $order->items()->with(['variant.product','variant.attributeValues.attribute'])->get();
        //dd($orderItems);
        // Lấy thông tin đơn hàng
        // $order =DB::table('order_items')
        // ->select(
        //     'order_items.id as order_id',
        //     DB::raw('MAX(products.thumbnail) as thumbnail'),
        //     DB::raw('MAX(products.name) as name'),
        //     DB::raw('MAX(attribute_values.value) as value'),
        //     DB::raw('MAX(order_items.quantity) as quantity'),
        //     DB::raw('MAX(order_items.product_sale_price) as product_sale_price')
        // )
        // ->join('products', 'order_items.product_sku', '=', 'products.sku')
        // ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
        // ->join('variant_attribute_values', 'product_variants.id', '=', 'variant_attribute_values.variant_id')
        // ->join('attribute_values', 'variant_attribute_values.attribute_value_id', '=', 'attribute_values.id')
        // ->join('orders', 'order_items.order_id', '=', 'orders.id')
        // ->where('orders.id', $id)
        // ->groupBy('order_items.id')
        // ->get();
        
        $user = Auth::user();
        return view('Clients.account.order_detail', compact('orderItems','order','user'));
    }
    public function repass()
    {
        $user = Auth::user();
        return view('Clients.account.repass', compact('user'));
    }
    public function updateRepass(Request $request)
    {
        $user = Auth::user();

        // Validate dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'old_pass' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Mật khẩu cũ không đúng.');
                }
            }],
            'new_pass' => 'required|string|min:8|confirmed', 
            'new_pass_confirmation' => 'required_with:new_pass|same:new_pass',
        ], 
        [
            'old_pass.required' => 'trường này không bỏ trống',
            
            'new_pass.required' => 'trường này không bỏ trống',
            'new_pass.string' => 'bạn phải nhập văn bản',
            'new_pass.min' => 'mật khẩu mới phải có ít nhất 8 ký tự',
            'new_pass.confirmed' => 'xác nhận mật khẩu không khớp',
        
            'new_pass_confirmation.required_with' => 'trường này không bỏ trống khi có mật khẩu mới',
            'new_pass_confirmation.same' => 'xác nhận mật khẩu phải khớp với mật khẩu mới',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->input('new_pass'));
        $user->save();

        return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công!');
    }
    public function cancelOrder($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        if ($order->order_status !== 'cancelled') {
            $order->order_status = 'cancelled';
            $order->save();

            return redirect()->route('user.order')->with('success', 'Đơn hàng đã được hủy thành công.');
        }

        return redirect()->route('user.order')->with('error', 'Đơn hàng đã được hủy trước đó.');
    }
    public function help()
    {
        return view('Clients.account.help');
    }
}
