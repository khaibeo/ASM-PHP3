<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingOrders = Order::where('order_status','pending')->count();
        $processingOrders = Order::where('order_status','processing')->count();
        $shippedOrders = Order::where('order_status','shipped')->count();
        $completedOrders = Order::where('order_status','delivered')->count();

        $recentOrders = Order::query()->select('id','name','phone','total_amount','order_status','created_at')
            ->latest('id')->take(10)->get();

        $bestSellingProducts = DB::table('products')
        ->select('products.id', 'products.name','products.sku','products.thumbnail', DB::raw('SUM(order_items.quantity) as total_sell'))
        ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
        ->join('order_items', 'product_variants.id', '=', 'order_items.product_variant_id')
        ->join('orders', 'orders.id', '=', 'order_items.order_id')
        ->where('orders.order_status', '=', 'delivered')
        ->groupBy('products.id', 'products.name')
        ->orderBy('total_sell', 'desc')
        ->get();

        return view("admin.dashboard", compact(
            'pendingOrders',
            'processingOrders',
            'shippedOrders',
            'completedOrders',
            'recentOrders',
            'bestSellingProducts'
        ));
    }
}
