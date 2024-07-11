<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/Product',[ProductController::class,'index'])->name('product.index');
Route::get('/Product-detail',[ProductController::class,'detail'])->name('product.detail');
Route::get('/Cart',[CartController::class,'index'])->name('cart.index');
Route::get('/Checkout',[CartController::class,'checkout'])->name('cart.checkout');

Route::prefix('admin')
    ->as('admin.')
    ->group(function() {
    Route::get('/', function(){
        return view("admin.dashboard");
    })->name('dashboard');

    Route::prefix('products')->as('products.')->group(function(){
        Route::get('/', function(){
            return view('admin.product.index');
        })->name('index');

        Route::get('/add',function(){
            return view('admin.product.add');
        })->name('add');

        Route::get('/edit',function(){
            return view('admin.product.edit');
        })->name('edit');

        Route::get('/variant',function(){
            return view('admin.product.variant');
        })->name('variant');

        Route::get('/variant',function(){
            return view('admin.product.variant');
        })->name('variant');

        Route::get('/color',function(){
            return view('admin.product.edit_color');
        })->name('edit_color');

        Route::get('/size',function(){
            return view('admin.product.edit_size');
        })->name('edit_size');
    });

    Route::prefix('catalogues')->as('catalogues.')->group(function(){
        Route::get('/', function(){
            return view('admin.catalogue.index');
        })->name('index');

        Route::get('/add',function(){
            return view('admin.catalogue.add');
        })->name('add');

        Route::get('/edit',function(){
            return view('admin.catalogue.edit');
        })->name('edit');
    });

    Route::prefix('orders')->as('orders.')->group(function(){
        Route::get('/', function(){
            return view('admin.order.index');
        })->name('index');

        Route::get('/detail',function(){
            return view('admin.order.detail');
        })->name('detail');
    });

    Route::prefix('users')->as('users.')->group(function(){
        Route::get('/', function(){
            return view('admin.user.index');
        })->name('index');

        Route::get('/add',function(){
            return view('admin.user.add');
        })->name('add');

        Route::get('/edit',function(){
            return view('admin.user.edit');
        })->name('edit');
    });

    Route::prefix('vouchers')->as('vouchers.')->group(function(){
        Route::get('/', function(){
            return view('admin.voucher.index');
        })->name('index');

        Route::get('/add',function(){
            return view('admin.voucher.add');
        })->name('add');

        Route::get('/edit',function(){
            return view('admin.voucher.edit');
        })->name('edit');
    });

    Route::prefix('banners')->as('banners.')->group(function(){
        Route::get('/', function(){
            return view('admin.banner.index');
        })->name('index');
    });

    Route::prefix('invoices')->as('invoices.')->group(function(){
        Route::get('/', function(){
            return view('admin.invoices.index');
        })->name('index');

        Route::get('/detail', function(){
            return view('admin.invoices.detail');
        })->name('detail');
    });
});

Route::get('dang-nhap', function(){
    return view('admin.auth.signin');
})->name('signin');

Route::get('repass', function(){
    return view('admin.auth.pass_reset');
})->name('repass');
