<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;
use App\Models\Catalogue;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', 1)->paginate(9);
        // dd($products);
        return view('Clients.product.product', compact('products'));
    }

    public function productByCategory(Request $request, $id)
    {

        $categoryBySlug = Catalogue::where('id', $id)->first();
        // dd($categoryBySlug);
       
        // Lấy danh sách sản phẩm theo danh mục
        $productsByCategory = Product::where('catalogue_id', $categoryBySlug->id)->paginate(9);
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


    public function detail()
    {
        return view('Clients.product.product-detail');
    }
    public function review()
    {
        return view('Clients.product.review-product');
    }
}
