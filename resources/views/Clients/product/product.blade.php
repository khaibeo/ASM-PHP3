@extends('Clients.layout')
@section('title')
    Sản phẩm
@endsection

@section('stylesheets')
    <link href="{{ asset('client/css/listing.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('client/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('client/js/specific_listing.js') }}"></script>
@endsection
@section('content')
    <div id="page" class="theia-exception">

        <main>
            <div class="top_banner">
                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                    <div class="container">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
                                {{-- <li><a href="#">Category</a></li> --}}
                                <li>Sản phẩm</li>
                            </ul>
                        </div>
                        <h1>Sản phẩm</h1>
                    </div>
                </div>
                <img src="https://hoctiengtrung.com/wp-content/uploads/2017/10/thiet-ke-banner-dep-cho-quang-cao-web-thoi-trang-1.jpeg"
                    height="300px" class="img-fluid" alt="">
            </div>
            <!-- /top_banner -->
            <div id="stick_here"></div>
            <div class="toolbox elemento_stick">
                <div class="container">
                    <ul class="clearfix">
                        <li>
                            <div class="sort_select">
                                <select name="sort" id="sort">
                                    <option value="date">Sắp xếp theo mới nhất</option>
                                    <option value="price">Sắp xếp theo: giá tăng dần</option>
                                    <option value="price-desc">Sắp xếp theo: giá giảm dần</option>
                                </select>
                            </div>
                        </li>
                        <li>
                            <a href="#0"><i class="ti-view-grid"></i></a>
                        </li>
                        <li>
                            <a href="#0" class="open_filters">
                                <i class="ti-filter"></i><span>Lọc</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /toolbox -->

            <div class="container margin_30">

                <div class="row">
                    <aside class="col-lg-3" id="sidebar_fixed">
                        <div class="filter_col">
                            <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
                            <div class="filter_type version_2">
                                <h4><a href="#filter_1" data-bs-toggle="collapse" class="opened">Thể loại</a></h4>
                                <div class="collapse show" id="filter_1">
                                    <ul>
                                        <li>

                                            <label class="container_check">Nam <small>12</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Nữ <small>24</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Quần<small>23</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Váy <small>11</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /filter_type -->
                            </div>
                            <!-- /filter_type -->
                            <div class="filter_type version_2">
                                <h4><a href="#filter_2" data-bs-toggle="collapse" class="opened">Màu sắc</a></h4>
                                <div class="collapse show" id="filter_2">
                                    <ul>
                                        <li>
                                            <label class="container_check">Xanh dương <small>06</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Đỏ <small>12</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Cam <small>17</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Đen <small>43</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /filter_type -->
                            <div class="filter_type version_2">
                                <h4><a href="#filter_3" data-bs-toggle="collapse" class="closed">Thương hiệu</a></h4>
                                <div class="collapse" id="filter_3">
                                    <ul>
                                        <li>
                                            <label class="container_check">Adidas <small>11</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Nike <small>08</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Vans <small>05</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Puma <small>18</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /filter_type -->
                            <div class="filter_type version_2">
                                <h4><a href="#filter_4" data-bs-toggle="collapse" class="closed">Giá</a></h4>
                                <div class="collapse" id="filter_4">
                                    <ul>
                                        <li>
                                            <label class="container_check">150000 - 250000<small>11</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">250000 — 500000<small>08</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- /filter_type -->
                            <div class="buttons">
                                <a href="#0" class="btn_1">Lọc</a> <a href="#0" class="btn_1 gray">Hủy</a>
                            </div>
                        </div>
                    </aside>
                    <!-- /col -->
                    <div class="col-lg-9">
                        <div class="row small-gutters">
                            @foreach ($products as $item)
                                <div class="col-6 col-md-4">
                                    <div class="grid_item">
                                        <span class="ribbon off">-30%</span>
                                        <figure>
                                            <a href="product-detail-1.html">
                                                @php
                                                    $img = filter_var($item->thumbnail, FILTER_VALIDATE_URL)
                                                        ? $item->thumbnail
                                                        : asset('storage/' . $item->thumbnail);
                                                @endphp
                                                <img class="img-fluid " src=" {{ $img }}"
                                                    alt="{{ $item->name }}">
                                            </a>
                                            <div data-countdown="2019/05/15" class="countdown"></div>
                                        </figure>
                                        <a href="{{ route('product.detail', $item->slug) }}">
                                            <h3>{{ $item->name }}</h3>
                                        </a>
                                        <div class="price_box">
                                            <span
                                                class="new_price">{{ number_format($item->regular_price, 0, '', '.') }}₫</span>
                                            <span
                                                class="old_price">{{ number_format($item->sale_price, 0, '', '.') }}₫</span>
                                        </div>
                                        <ul>
                                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="Add to favorites"><i
                                                        class="ti-heart"></i><span>Thêm vào yêu thích</span></a></li>
                                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="Add to compare"><i
                                                        class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="Add to cart"><i
                                                        class="ti-shopping-cart"></i><span>Thêm vào giỏ hàng</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /grid_item -->
                                </div>
                            @endforeach


                        </div>
                        <!-- /row -->


                        @if ($products->total() > 9)
                            @php
                                $totalPages = ceil($products->total() / 9);
                                $currentPage = $products->currentPage();
                                $start_page = max(1, $currentPage - 3);
                                $end_page = min($totalPages, $currentPage + 3);
                            @endphp

                            <div class="pagination__wrapper">
                                <ul class="pagination">
                                    <li>
                                        <a href="?page={{ max(1, $currentPage - 1) }}" class="prev"
                                            title="previous page">&laquo;</a>
                                    </li>
                                    @for ($i = $start_page; $i <= $end_page; $i++)
                                        <li class="{{ $i == $currentPage ? 'active' : '' }}">
                                            <a href="?page={{ $i }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <li>
                                        <a href="?page={{ min($totalPages, $currentPage + 1) }}" class="next"
                                            title="next page">&raquo;</a>
                                    </li>
                                </ul>
                            </div>
                        @endif

                    </div>

                    <!-- /col -->
                </div>
                <!-- /row -->

            </div>
            <!-- /container -->
        </main>
        <!-- /main -->


    </div>
    <!-- page -->
@endsection
