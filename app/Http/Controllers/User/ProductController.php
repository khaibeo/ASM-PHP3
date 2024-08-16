<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Catalogue;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', 1)->latest('id')->paginate(9);
        // dd($products);
        return view('Clients.product.product', compact('products'));
    }

    public function productByCategory(Request $request, $id)
    {

        $categoryBySlug = Catalogue::where('id', $id)->firstOrFail();
        // dd($categoryBySlug);
       
        // Lấy danh sách sản phẩm theo danh mục
        $productsByCategory = Product::where('catalogue_id', $categoryBySlug->id)->latest('id')->paginate(9);
        // dd($productsByCategory);
        // Trả về view và truyền dữ liệu vào view
        return view('Clients.product.product-by-category', [
            'category' => $categoryBySlug,
            'products' => $productsByCategory
        ]);
    }

    // public function category($slug)
    // {
    //     // Giả sử bạn có một model Category và Product với mối quan hệ tương ứng
    //     $category = Product::where('slug', $slug)->firstOrFail();
    //     // $products = $category->products()->paginate(9); // Giới hạn 9 sản phẩm mỗi trang

    //     return view('product.category', compact('category', 'products'));
    // }

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

    public function search(Request $request)
    {

        $data = $request->validate(
            [
                'query' => 'required|string|max:255',
            ],
        );

        $products = Product::where('name', 'like', "%{$data['query']}%")->paginate(9);
        return view('Clients.product.product', compact('products'));
    }
}
