<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderModel;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::query()->find($id);

        $orderItems = $order->items()->with(['variant.product','variant.attributeValues.attribute'])->get();

        return view('admin.order.detail',compact('order','orderItems'));
    }

    public function editStatus($id)
    {
        $order = OrderModel::find($id);
        if (!$order) {
            return redirect()->route('admin.orders.index');
        }
        return view('admin.order.edit-status', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|string|max:255',
        ]);

        $order = OrderModel::find($id);
        if (!$order) {
            return redirect()->route('admin.orders.index');
        }

        $order->order_status = $request->order_status;
        $order->save();

        return back()->with('msg','Cập nhật trạng thái thành công');

        // return redirect()->route('admin.orders.index');
    }

    public function delete($id)
    {
        $order = OrderModel::getSingle($id);
        $order->delete();
        return redirect()->route('admin.orders.index');
    }
}
