<?php

namespace App\Http\Middleware;

use App\Models\Catalogue;
use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Cart;

class ShareCategories
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $categories = Catalogue::whereNull('parent_id')
            ->with('children')
            ->get();
        
        if(Auth::check()){
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            $cartItems = $cart->items;

            $countCart = $cartItems->count();

            $total = $cartItems->sum(function ($item) {
                $price = $item->variant?->sale_price ?? $item->variant?->regular_price;
                return $item->quantity * $price;
            });

            View::share('numCartItem', $countCart);
            View::share('totalCart', $total);
        }

        View::share('categories', $categories);

        return $next($request);
    }

}
