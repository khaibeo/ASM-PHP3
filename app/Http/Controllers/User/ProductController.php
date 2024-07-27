<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('Clients.product.product');
    }
    public function detail($slug)
    {
        $product = Product::with(['variants.attributeValues.attribute','galleries','catalogue'])->whereSlug($slug)->firstOrFail();
        $relatedProduct = Product::query()->where('catalogue_id',$product->catalogue_id)->whereNot('id',$product->id)->get();

        // Nhóm các thuộc tính và giá trị
        $attributes = $product->variants->flatMap(function ($variant) {
            return $variant->attributeValues;
        })->groupBy(function ($attributeValue) {
            return $attributeValue->attribute->name;
        });

        // Tạo một mảng các biến thể với các thuộc tính
        $variantsData = $product->variants->map(function ($variant) {
            return [
                'id' => $variant->id,
                'regular_price' => $variant->regular_price,
                'sale_price' => $variant->sale_price,
                'stock' => $variant->stock,
                'attributes' => $variant->attributeValues->mapWithKeys(function ($av) {
                    return [$av->attribute->name => $av->id];
                })
            ];
        });

        return view('Clients.product.product-detail',compact('product', 'attributes', 'variantsData','relatedProduct'));
    }
    public function review()
    {
        return view('Clients.product.review-product');
    }
}
