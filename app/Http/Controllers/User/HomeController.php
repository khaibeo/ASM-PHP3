<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class HomeController extends Controller
{
    public function index(){
        $categories = Catalogue::with('children')->whereNull('parent_id')->get();
        $mostViewedProducts = Product::orderBy('views', 'desc')
            ->take(8)
            ->get();

        // Lấy 3 sản phẩm mới nhất
        $newestProducts = Product::orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Lấy 3 sản phẩm nổi bật
        $featuredProducts = Product::where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Gộp tất cả vào một mảng
        $products = [
            'most_viewed' => $mostViewedProducts,
            'newest' => $newestProducts,
            'featured' => $featuredProducts,
        ];
        $featuredProductstop = Product::where('is_featured', true)
        ->orderBy('created_at', 'desc')
        ->get();
        $activeSlides = Slider::where('active',true)->with('details')->get();
        return view('Clients.home.index',compact('products'),['categories'=>$categories,'featuredProductstop'=>$featuredProductstop,'activeSlides'=>$activeSlides]);
    }
    public function about(){
        return view('Clients.home.about');
    }
    public function contact(){
        return view('Clients.home.contact');
    }
    public function blog(){
        return view('Clients.home.blog');
    }
    public function getCataloues(){

    }
}