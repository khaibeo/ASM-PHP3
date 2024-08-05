<?php

use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\VoucherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\VoucherController as AdminVoucherController;
use App\Http\Controllers\User\CheckoutController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/blog', [HomeController::class, 'blog'])->name('home.blog');

Route::get('/product-review', [ProductController::class, 'review'])->name('product.review');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product-by-category/{id}', [ProductController::class, 'productByCategory'])->name('product.category');
Route::get('/san-pham/{slug}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/product-review', [ProductController::class, 'review'])->name('product.review');
Route::get('/product/search', [ProductController::class, 'search'])->name('product.search');

//Giỏ hàng
Route::controller(CartController::class)
    ->prefix('cart')->as('cart.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/add', 'add')->name('add');
        Route::post('/update', 'update')->name('update');
        Route::delete('/remove', 'remove')->name('remove');
    });

// Thanh toán
Route::controller(CheckoutController::class)
    ->prefix('checkout')->as('checkout.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'process')->name('process');
        Route::get('/success/{order}', 'success')->name('success');
        Route::post('/voucher', 'checkVoucher')->name('voucher');
    });

//Tài khoản
Route::controller(UserController::class)
    ->prefix('user')->as('user.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/profile','profile')->name('profile');
        Route::post('/profile','updateProfile')->name('update');
        Route::get('/repass', 'repass')->name('repass');
        Route::post('/repass', 'updateRepass')->name('updaterepass');
        Route::get('/order', 'orderlist')->name('order');
        Route::get('/order/{id}', 'showOrderDetail')->name('orderdetail');
        Route::get('/order/cancel/{id}',  'cancelOrder')->name('ordercancel');
        Route::get('/order/pay/{id}', 'payOrder')->name('orderpay');
    });


// Thanh toán online
Route::get('/vnpay_payment', [PaymentController::class, 'vnpayPayment'])->name('payment');
Route::get('/check_payment', [PaymentController::class, 'checkPayment'])->name('payment.check');
Route::get('/payment-fail/{id}', [PaymentController::class, 'showError'])->name('payment.fail');
Route::put('/payment/{id}', [PaymentController::class, 'changePaymentMethod'])->name('changePaymentMethod');

Route::get('/help', [UserController::class, 'help'])->name('user.help');
Route::get('/voucher', [VoucherController::class, 'list'])->name('voucher.list');

Route::prefix('auth')->as('auth.')->group(function () {
    Route::get('/', [AuthController::class, 'showFormAuth'])->name('index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('admin/login', [AdminAuthController::class, 'showFormLogin'])->name('admin.login');
    Route::post('admin/login', [AdminAuthController::class, 'login']);
});


//Route admin
Route::prefix('admin')
    ->as('admin.')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/', function () {
            return view("admin.dashboard");
        })->name('dashboard');

        // Sản phẩm
        Route::controller(AdminProductController::class)
            ->prefix('products')->as('products.')
            ->group(function () {
                Route::get('/', 'index')->name('index');

                Route::get('/add', 'add')->name('add');
                Route::post('/add', 'store')->name('store');

                Route::get('/{id}', 'edit')->name('edit');
                Route::put('/{id}', 'update')->name('update');

                Route::delete('/{id}', 'destroy')->can('admin')->name('destroy');
            });

        // Danh mục sản phẩm
        Route::controller(CatalogueController::class)
            ->prefix('catalogues')->as('catalogues.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/add', 'create')->name('add');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('destroy');
            });

        // Người dùng
        Route::controller(AdminUserController::class)
            ->prefix('users')->as('users.')
            ->middleware('can:admin')
            ->group(function () {
                Route::get('/', 'index')->name('index');

                Route::get('/add', function () {
                    return view('admin.user.add');
                })->name('add');
                Route::post('/store/user', 'storeUser')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            });

        // Đơn hàng
        Route::controller(OrderController::class)
            ->prefix('orders')->as('orders.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit-status/{id}', 'editStatus')->name('editStatus');
                Route::post('/update-status/{id}', 'updateStatus')->name('updateStatus');
                Route::get('/detail/{id}', 'detail')->name('detail');
                Route::get('/delete/{id}', 'delete')->middleware('can:admin')->name('delete');
                Route::get('/print/{id}', 'print')->name('print');
                Route::get('/export', 'showExport')->name('export');
            });

        // Mã giảm giá
        Route::controller(AdminVoucherController::class)
            ->prefix('vouchers')->as('vouchers.')
            ->middleware('can:admin')
            ->group(function () {
                Route::get('/index', 'list')->name('index');
                Route::get('/add', 'add')->name('add');
                Route::post('/add', 'insert');
                Route::get('/import', 'showImport')->name('import');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/edit/{id}', 'update');
                Route::get('/delete/{id}', 'delete')->name('delete');
            });

        // Banner
        Route::controller(BannerController::class)
            ->prefix('banners')->as('banners.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/{id}', 'edit')->name('edit');
                Route::put('/{id}', 'update')->name('update');
                Route::delete('/{id}', 'destroy')->name('destroy');
                Route::post('/{id}/update-status', 'updateStatus')->name('updateStatus');
            });


        // Hóa đơn
        Route::prefix('invoices')->as('invoices.')->group(function () {
            Route::get('/', function () {
                return view('admin.invoices.index');
            })->name('index');

            Route::get('/detail', function () {
                return view('admin.invoices.detail');
            })->name('detail');
        });

        Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
