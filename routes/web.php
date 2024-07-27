<?php

use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\VoucherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\VoucherController as AdminVoucherController;


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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/blog', [HomeController::class, 'blog'])->name('home.blog');
Route::get('/Product', [ProductController::class, 'index'])->name('product.index');
Route::get('/san-pham/{slug}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/Product-review', [ProductController::class, 'review'])->name('product.review');
Route::get('/Cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/Checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/user/repass', [UserController::class, 'repass'])->name('user.repass');
Route::get('/order', [UserController::class, 'orderlist'])->name('user.order');
Route::get('/help', [UserController::class, 'help'])->name('user.help');
Route::get('/voucher', [VoucherController::class, 'list'])->name('voucher.list');
Route::post('/save-voucher/{id}', [VoucherController::class, 'saveVoucher'])->name('save.voucher');

Route::prefix('auth')->as('auth.')->group(function () {
    Route::get('/', [AuthController::class, 'showFormAuth'])->name('index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('admin/login', [AdminAuthController::class, 'showFormLogin'])->name('admin.login');
    Route::post('admin/login', [AdminAuthController::class, 'login']);
});

Route::prefix('admin')
    ->as('admin.')
    // ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', function () {
            return view("admin.dashboard");
        })->name('dashboard');

        Route::prefix('products')->as('products.')->group(function () {
            Route::get('/', [AdminProductController::class, 'index'])->name('index');

            Route::get('/add', [AdminProductController::class, 'add'])->name('add');
            Route::post('/add', [AdminProductController::class, 'store'])->name('store');

            Route::get('/{id}', [AdminProductController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminProductController::class, 'update'])->name('update');

            Route::delete('/{id}', [AdminProductController::class, 'destroy'])->name('destroy');

            Route::get('/variant', function () {
                return view('admin.product.variant');
            })->name('variant');

            Route::get('/variant', function () {
                return view('admin.product.variant');
            })->name('variant');

            Route::get('/color', function () {
                return view('admin.product.edit_color');
            })->name('edit_color');

            Route::get('/size', function () {
                return view('admin.product.edit_size');
            })->name('edit_size');
        });

        Route::prefix('catalogues')->as('catalogues.')->group(function () {
            Route::get('/', [CatalogueController::class, 'index'])->name('index');
            Route::get('/add', [CatalogueController::class, 'create'])->name('add');
            Route::post('/store', [CatalogueController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CatalogueController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [CatalogueController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [CatalogueController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('users')->as('users.')->group(function () {
            // Route::get('/', function(){
            //     return view('admin.user.index');
            // })->name('index');
            Route::get('/', [AdminUserController::class, 'index'])->name('index');

            Route::get('/add', function () {
                return view('admin.user.add');
            })->name('add');

            Route::post('/store/user', [AdminUserController::class, 'storeUser'])->name('store');
            // Route::get('/edit',function(){
            //     return view('admin.user.edit');
            // })->name('edit');
    
            Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [AdminUserController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('orders')->as('orders.')->group(function () {
            Route::get('/index', [OrderController::class, 'index'])->name('index');
            Route::get('/edit-status/{id}', [OrderController::class, 'editStatus'])->name('editStatus');
            Route::post('/update-status/{id}', [OrderController::class, 'updateStatus'])->name('updateStatus');
            Route::get('/detail/{id}',[OrderController::class, 'detail'])->name('detail');
            Route::get('/delete/{id}', [OrderController::class, 'delete'])->name('delete');
        });

        Route::prefix('vouchers')->as('vouchers.')->group(function () {
            Route::get('/index', [AdminVoucherController::class, 'list'])->name('index');
            Route::get('/add', [AdminVoucherController::class, 'add'])->name('add');
            Route::post('/add', [AdminVoucherController::class, 'insert']);
            Route::get('/edit/{id}', [AdminVoucherController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}', [AdminVoucherController::class, 'update']);
            Route::get('/delete/{id}', [AdminVoucherController::class, 'delete'])->name('delete');
        });

        Route::prefix('banners')->as('banners.')->group(function () {
            Route::get('/', function () {
                return view('admin.banner.index');
            })->name('index');
        });

        Route::prefix('invoices')->as('invoices.')->group(function () {
            Route::get('/', function () {
                return view('admin.invoices.index');
            })->name('index');

            Route::get('/detail', function () {
                return view('admin.invoices.detail');
            })->name('detail');
        });

        Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');
        // Route::get('logout', [AdminAuthController::class,'logout'])->name('repass');
    });