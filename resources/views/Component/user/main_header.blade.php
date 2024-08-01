<header class="version_1">
    <div class="layer"></div><!-- Mobile menu overlay mask -->
    <div class="main_header">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                    <div id="logo">
                        <a href="{{ route('home.index') }}"><img src="{{ asset('client/img/logo.svg') }}" alt=""
                                width="100" height="35"></a>
                    </div>
                </div>
                <nav class="col-xl-6 col-lg-7">
                    <a class="open_close" href="javascript:void(0);">
                        <div class="hamburger hamburger--spin">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                    <!-- Mobile menu button -->
                    <div class="main-menu">
                        <div id="header_menu">
                            <a href="/"><img src="img/logo_black.svg" alt="" width="100"
                                    height="35"></a>
                            <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                        </div>
                        <ul>
                            <li>
                                <a href="{{ route('home.index') }}">Trang chủ</a>
                            </li>
                            <li class="megamenu">
                                <a href="{{ route('product.index') }}">Sản phẩm</a>
                            </li>
                            <li>
                                <a href="{{ route('voucher.list') }}">Khuyến mãi</a>
                            </li>
                            <li>
                                <a href="{{ route('home.about') }}">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="{{ route('home.contact') }}">Liên hệ</a>
                            </li>
                            {{-- <li>
									<a href="{{route('home.blog')}}">Bài viết</a>
								</li> --}}
                        </ul>
                    </div>
                    <!--/main-menu -->
                </nav>
                <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-end">
                    <a class="phone_top"><strong><span>Cần hỗ trợ?</span>0346 315 304</strong></a>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /main_header -->

    <div class="main_nav Sticky">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <nav class="categories">
                        <ul class="clearfix">
                            <li><span>
                                    <a href="#">
                                        <span class="hamburger hamburger--spin">
                                            <span class="hamburger-box">
                                                <span class="hamburger-inner"></span>
                                            </span>
                                        </span>
                                        Danh mục sản phẩm
                                    </a>
                                </span>
                                <div id="menu">
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li>
                                                <span>
                                                    <a href="{{ route('product.category', $category->id) }}">
                                                        {{ $category->name }}
                                                    </a>
                                                </span>
                                                <div id="menu">
                                                    <ul>
                                                        @foreach ($category->children as $child)
                                                            <li><a
                                                                    href="{{ route('product.category', $child->id) }}">{{ $child->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                    <div class="custom-search-input">
                        <form action="{{ route('product.search') }}" method="GET">
                            <input type="text" name="query" value="{{ request()->query('query') }}"
                                placeholder="Tìm kiếm sản phẩm...">
                            <button type="submit"><i class="header-icon_search_custom"></i></button>
                        </form>
                    </div>

                    {{-- <div class="row">
                        <div class="col-md-6 offset-md-2"> --}}
                    {{-- <div class="list-group">
                                @foreach ($products as $product)
                                    <a href="#" class="list-group-item list-group-item-action">
                                        {{ $product->name }}
                                    </a>
                                @endforeach
                           </div> --}}
                    {{-- </div>
                    </div> - --}}
                    {{-- <div>
                        {{ $products->links() }}
                    </div> --}}
                </div>
                <div class="col-xl-3 col-lg-2 col-md-3">
                    <ul class="top_tools">
                        <li>
                            <div class="dropdown dropdown-access">
                                <a href="#" class="access_link"><span>Tài khoản</span></a>
                                <div class="dropdown-menu">
                                    @if (!Auth::check())
                                        <a href="{{ route('auth.index') }}" class="btn_1">Đăng nhập / Đăng ký</a>
                                    @endif

                                    <ul>
                                        <li>
                                            <a href="{{ route('user.order') }}"><i class="ti-package"></i>Đơn hàng của
                                                tôi</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user.profile') }}"><i class="ti-user"></i>Thông tin tài
                                                khoản</a>
                                        </li>
                                        @if (\Auth::check())
                                            <li>
                                                <a href="{{ route('auth.logout') }}"><i class="ti-help-alt"></i>Đăng
                                                    xuất</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <!-- /dropdown-access-->
                        </li>
                        <li>
                            <div class="dropdown dropdown-cart">
                                <a href="{{ route('cart.index') }}" class="cart_bt"><strong>2</strong></a>
                                <div class="dropdown-menu">
                                    <div class="total_drop">
                                        <a href="{{ route('cart.index') }}" class="btn_1 outline">Xem giỏ hàng</a>
                                        <a href="{{ route('checkout.index') }}" class="btn_1">Thanh toán</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /dropdown-cart-->
                        </li>
                        {{-- <li>
								<a href="#0" class="wishlist"><span>Wishlist</span></a>
							</li> --}}

                        <!-- <li>
        <a href="javascript:void(0);" class="btn_search_mob"><span>Search</span></a>
       </li>
       <li>
        <a href="#menu" class="btn_cat_mob">
         <div class="hamburger hamburger--spin" id="hamburger">
          <div class="hamburger-box">
           <div class="hamburger-inner"></div>
          </div>
         </div>
         Categories
        </a>
       </li> -->
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <div class="search_mob_wp">
            <input type="text" class="form-control" placeholder="Search over 10.000 products">
            <input type="submit" class="btn_1 full-width" value="Search">
        </div>
        <!-- /search_mobile -->
    </div>
    <!-- /main_nav -->
</header>
