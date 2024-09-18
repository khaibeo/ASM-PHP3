<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query()->orderBy('id', 'desc');

        if ($request->has('date') && $request->input('date') != '') {
            $date = $request->date;

            if (Str::contains($date, 'to')) {
                $date = explode(' to', $date);

                $query = $query->whereBetween('created_at', [Carbon::parse($date[0])->startOfDay(), Carbon::parse($date[1])->endOfDay()]);
            } else {
                $query = $query->whereDate('created_at', Carbon::parse($date)->format('Y-m-d'));
            }
        }

        if ($request->has('status') && $request->input('status') != 'all') {
            $query = $query->where('order_status', $request->status);
        }

        if ($request->has('payment') && $request->input('payment') != 'all') {
            $query = $query->where('payment_method', $request->payment);
        }

        $query = $query->get();

        return view('admin.order.index', ['orders' => $query]);
    }

    public function detail($id)
    {
        $order = Order::query()->find($id);

        $orderItems = $order->items()->with(['variant.product', 'variant.attributeValues.attribute'])->get();

        return view('admin.order.detail', compact('order', 'orderItems'));
    }

    public function editStatus($id)
    {
        $order = Order::find($id);
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

        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('admin.orders.index');
        }

        $order->order_status = $request->order_status;
        $order->save();

        return back()->with('msg', 'Cập nhật trạng thái thành công');

        // return redirect()->route('admin.orders.index');
    }

    public function delete($id)
    {
        $order = Order::find($id);

        OrderItem::query()->where('order_id',$id)->delete();
        
        $order->delete();
        return redirect()->route('admin.orders.index');
    }

    public function print($id)
    {
        $order = Order::query()->find($id);

        $orderItems = $order->items()->with(['variant.product', 'variant.attributeValues.attribute'])->get();

        return view('admin.invoices.detail', compact('order', 'orderItems'));
    }

    public function showExport()
    {
        return view('admin.order.export');
    }

    public function export(Request $request)
    {
        try {
            $query = Order::query()->orderBy('id', 'desc');

            if ($request->has('date') && $request->input('date') != '') {
                $date = $request->date;

                if (Str::contains($date, 'to')) {
                    $date = explode('to', $date);

                    $query = $query->whereBetween('created_at', [Carbon::parse($date[0])->startOfDay(), Carbon::parse($date[1])->endOfDay()]);
                } else {
                    $query = $query->whereDate('created_at', Carbon::parse($date)->format('Y-m-d'));
                }
            }

            if ($request->has('status') && $request->input('status') != 'all') {
                $query = $query->where('order_status', $request->status);
            }

            if ($request->has('payment') && $request->input('payment') != 'all') {
                $query = $query->where('payment_method', $request->payment);
            }

            if ($request->has('min')) {
                $query->where('total_amount', '>=', floatval($request->min));
            }

            if ($request->has('max') && $request->max != '') {
                $query->where('total_amount', '<=', floatval($request->max));
            }

            $fileName = 'orders_' . date('Y-m-d_His') . '.xlsx';

            $path = storage_path('app/public/' . $fileName);
            Excel::store(new OrderExport($query), 'public/' . $fileName);

            $url = url('storage/' . $fileName);
            return response()->json([
                'success' => true,
                'message' => 'Export thành công',
                'file_name' => $fileName,
                'file_url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xuất dữ liệu: ' . $e->getMessage(),
            ], 500);
        }
    }
}
