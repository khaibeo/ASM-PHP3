<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $data['order'] = OrderModel::getAll();
        return view('admin.order.index', $data);
    }

    public function detail($id)
    {
        $data['order'] = OrderModel::getSingle($id);
        return view('admin.order.detail', $data);
    }

    public function store(Request $request)
    {
        // Implementation here
    }

    public function show(string $id)
    {
        // Implementation here
    }

    public function edit(string $id)
    {
        // Implementation here
    }

    public function update(Request $request, string $id)
    {
        // Implementation here
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

        return redirect()->route('admin.orders.index');
    }

    public function delete($id)
    {
        $order = OrderModel::getSingle($id);
        $order->delete();
        return redirect()->route('admin.orders.index');
    }
}
