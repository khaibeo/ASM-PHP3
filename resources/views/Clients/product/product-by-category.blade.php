@extends('Clients.layout')
@section('title')
    {{ $category->name }}
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
                                <li>{{ $category->name }}</li>
                            </ul>
                        </div>
                        <h1>{{ $category->name }} </h1>
                    </div>
                </div>
                <img src="https://thegioidohoa.com/wp-content/uploads/2015/10/thiet-ke-banner-an-tuong-cho-web-thoi-trang1.jpg" class="img-fluid" alt="">
            </div>
            <!-- /top_banner -->
            <div id="stick_here"></div>
            <div class="toolbox elemento_stick">
                <div class="container">
                    <ul class="clearfix">
                        <li>
                            <div class="sort_select">
                                <select name="sort" id="sort">
                                    <option value="popularity" selected="selected">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by newness</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </div>
                        </li>
                        <li>
                            <a href="#0"><i class="ti-view-grid"></i></a>
                            <a href="listing-row-1-sidebar-left.html"><i class="ti-view-list"></i></a>
                        </li>
                        <li>
                            <a href="#0" class="open_filters">
                                <i class="ti-filter"></i><span>Filters</span>
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
                                <h4><a href="#filter_1" data-bs-toggle="collapse" class="opened">Danh mục</a></h4>
                                <div class="collapse show" id="filter_1">
                                    <ul>
                                        @foreach ($categories as $cat)
                                            <li>
                                                <label class="container_check">
                                                    <a href="{{ $cat->id }}">{{ $cat->name }}</a>
                                                    <small>{{ $cat->products_count }}</small>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /filter_type -->
                            </div>
                            <!-- /filter_type -->
                        </div>
                    </aside>
                    <!-- /col -->
                    <div class="col-lg-9">
                        <div class="row small-gutters">
                            @foreach ($products as $item)
                                <div class="col-6 col-md-4">
                                    <div class="grid_item">
                                        {{-- <span class="ribbon off">-30%</span> --}}
                                        <figure>
                                            <a href="product-detail-1.html">
                                                @php
                                                    $img = filter_var($item->thumbnail, FILTER_VALIDATE_URL) ? $item->thumbnail : asset('storage/' . $item->thumbnail);
                                                @endphp
                                                <img class="img-fluid" style="max-height: 290px" src="{{ $img }}" alt="{{ $item->name }}">
                                            </a>
                                            {{-- <div data-countdown="2019/05/15" class="countdown"></div> --}}
                                        </figure>
                                        <a href="{{ route('product.detail', ['slug' => $item->slug]) }}">
                                            <h3>{{ $item->name }}</h3>
                                        </a>
                                        <div class="price_box">
                                            <span class="new_price">{{ number_format($item->regular_price, 0, '', '.') }}₫</span>
                                            <span class="old_price">{{ number_format($item->sale_price, 0, '', '.') }}₫</span>
                                        </div>
                                        
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
                                        <a href="?page={{ max(1, $currentPage - 1) }}" class="prev" title="previous page">&laquo;</a>
                                    </li>
                                    @for ($i = $start_page; $i <= $end_page; $i++)
                                        <li class="{{ $i == $currentPage ? 'active' : '' }}">
                                            <a href="?page={{ $i }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li>
                                        <a href="?page={{ min($totalPages, $currentPage + 1) }}" class="next" title="next page">&raquo;</a>
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
