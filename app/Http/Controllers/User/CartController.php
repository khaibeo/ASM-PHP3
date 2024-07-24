<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index(){
        $cart = $this->getCart();

        $cartItems = $cart->items()->with(['variant.product','variant.attributeValues.attribute'])->get();

        $cartItems = $cartItems->map(function ($item) {
            $variantAttributes = $item->variant->attributeValues->map(function ($av) {
                return $av->attribute->name . ': ' . $av->value;
            })->implode(', ');

            $item->variantAttributes = $variantAttributes;
            return $item;
        });

        $total = $cartItems->sum(function ($item) {
            $price = $item->variant->sale_price ?? $item->variant->regular_price;
            return $item->quantity * $price;
        });

        return view('Clients.cart.cart',compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $variant = ProductVariant::findOrFail($request->variant_id);

        // Kiểm tra xem variant có thuộc về product không
        if ($variant->product_id !== $product->id) {
            return back()->with('error', 'Biến thể không hợp lệ cho sản phẩm này.');
        }

        // Kiểm tra số lượng tồn kho
        if ($variant->stock < $request->quantity) {
            return back()->with('error', 'Số lượng yêu cầu vượt quá số lượng tồn kho.');
        }

        // Lấy giỏ hàng hiện tại hoặc tạo mới nếu chưa có
        $cart = $this->getCart();

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $existingItem = $cart->items()->where('product_variant_id', $variant->id)->first();

        if ($existingItem) {
            // Nếu đã có, cập nhật số lượng
            $newQuantity = $existingItem->quantity + $request->quantity;
            if ($newQuantity > $variant->stock) {
                return back()->with('error', 'Số lượng yêu cầu vượt quá số lượng tồn kho.');
            }
            $existingItem->update(['quantity' => $newQuantity]);
        } else {
            // Nếu chưa có, thêm mới vào giỏ hàng
            $cart->items()->create([
                'product_variant_id' => $variant->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    private function getCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $cartItem = CartItem::findOrFail($request->item_id);
            $variant = $cartItem->variant;

            if ($variant->stock < $request->quantity) {
                return response()->json(['error' => 'Số lượng yêu cầu vượt quá số lượng tồn kho.'], 422);
            }

            $cartItem->update(['quantity' => $request->quantity]);

            $price = $variant->sale_price ?? $variant->regular_price;
            $itemTotal = $price * $cartItem->quantity;

            $cart = $this->getCart();
            $total = $this->calculateCartTotal($cart);

            return response()->json([
                'success' => true,
                'itemTotal' => number_format($itemTotal) . ' đ',
                'total' => number_format($total) . ' đ',
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating cart item: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật số lượng sản phẩm.'
            ], 500);
        }
    }

    public function remove(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id',
        ]);

        try {
            $cartItem = CartItem::findOrFail($request->item_id);
            $cartItem->delete();

            $cart = $this->getCart();
            $total = $this->calculateCartTotal($cart);

            return response()->json([
                'success' => true,
                'total' => number_format($total) . ' đ',
            ]);
        } catch (\Exception $e) {
            Log::error('Error removing cart item: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa sản phẩm khỏi giỏ hàng.'
            ], 500);
        }
    }

    private function calculateCartTotal($cart)
    {
        $total = 0;
        foreach ($cart->items as $item) {
            $price = $item->variant->sale_price ?? $item->variant->regular_price;
            $total += $item->quantity * $price;
        }
        return $total;
    }
}
