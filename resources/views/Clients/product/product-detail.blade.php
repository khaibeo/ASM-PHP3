@extends('Clients.layout')
@section('title')
    Chi tiết sản phẩm
@endsection
@section('stylesheets')
    <link href="{{ asset('client/css/product_page.css') }}" rel="stylesheet">

    <style>
        .form-group {
            margin-bottom: 15px;
        }

        select:disabled {
            background-color: #e9ecef;
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="container margin_30">
			@if ($errors->any())
				<div class="alert alert-danger">Đã có lỗi xảy ra, vui lòng thử lại !</div>
			@endif

			@session('error')
                <div class="alert alert-danger">{{session('error')}}</div>	
			@enderror

            <div class="row">
                <div class="col-md-6">
                    <div class="all">
                        <div class="slider">
                            <div class="owl-carousel owl-theme main">
                                <div style="background-image: url({{ asset(\Storage::url($product->thumbnail)) }});"
                                    class="item-box"></div>
                                @foreach ($product->galleries as $image)
                                    <div style="background-image: url({{ asset(\Storage::url($image->image)) }});"
                                        class="item-box"></div>
                                @endforeach
                            </div>
                            <div class="left nonl"><i class="ti-angle-left"></i></div>
                            <div class="right"><i class="ti-angle-right"></i></div>
                        </div>
                        <div class="slider-two">
                            <div class="owl-carousel owl-theme thumbs">
                                <div style="background-image: url({{ asset(\Storage::url($product->thumbnail)) }});"
                                    class="item active"></div>
                                @foreach ($product->galleries as $key => $image)
                                    <div style="background-image: url({{ asset(\Storage::url($image->image)) }});"
                                        class="item {{ $key == 0 ? 'active' : '' }}"></div>
                                @endforeach
                            </div>
                            <div class="left-t nonl-t"></div>
                            <div class="right-t"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
                            <li><a href="#">Danh mục</a></li>
                            <li>{{ $product->catalogue->name }}</li>
                        </ul>
                    </div>
                    <!-- /page_header -->
                    <div class="prod_info">
                        <form id="add-to-cart-form" action="{{route('cart.add')}}" method="POST">
                            <h1>{{ $product->name }}</h1>
                            {{-- <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i><em>4
                                reviews</em></span> --}}
                            <p class="mb-2"><small>SKU: {{ $product->sku }}</small><br>{{ $product->short_description }}</p>
							<div class="row mb-3">
                                <div class="col-lg-5 col-md-6">
                                    <div class="price_main"><span class="new_price">
                                            {{ $product->sale_price ? number_format($product?->sale_price) . 'đ' : '' }}</span>
                                        <span class="old_price">{{ number_format($product?->regular_price) . 'đ' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="prod_options pt-1">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="variant_id" id="variant_id">

                                <div id="attribute-container">
                                    
                                </div>

                                <div class="form-group row">
										<label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Số lượng</strong></label>
										<div class="col-xl-4 col-lg-5 col-md-6 col-6">
											<div class="numbers-row">
												<input type="number" min="1" value="1" id="quantity" name="quantity" class="qty2">
											</div>
										</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    <div id="variant-info price_main">
										<span class="new_price fs-5"><span id="variant-price"></span> đ <span class="old_price" id="variant-regular-price"></span> đ</span>
										<p class="fs-6">Còn lại: <span id="variant-stock"></span></p>
									</div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div><button type="submit" class="btn btn-primary p-2" id="add-to-cart-btn"
                                            disabled>Thêm
                                            vào giỏ hàng</button></div>
                                </div>
                            </div>
							@csrf
                        </form>
                    </div>
                    <!-- /prod_info -->
                    {{-- <div class="product_actions">
                        <ul>
                            <li>
                                <a href="#"><i class="ti-heart"></i><span>Add to Wishlist</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="ti-control-shuffle"></i><span>Add to Compare</span></a>
                            </li>
                        </ul>
                    </div> --}}
                    <!-- /product_actions -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

        <div class="tabs_product">
            <div class="container">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-A" class="nav-link active" data-bs-toggle="tab"
                            role="tab">Description</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-B" href="#pane-B" class="nav-link" data-bs-toggle="tab" role="tab">Reviews</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /tabs_product -->
        <div class="tab_content_wrapper">
            <div class="container">
                <div class="tab-content" role="tablist">
                    <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5 class="mb-0">
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-A" aria-expanded="false"
                                    aria-controls="collapse-A">
                                    Mô tả sản phẩm
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-12 col-lg-6">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /TAB A -->
                    <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                        <div class="card-header" role="tab" id="heading-B">
                            <h5 class="mb-0">
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B" aria-expanded="false"
                                    aria-controls="collapse-B">
                                    Đánh giá
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                            {{-- <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i
                                                        class="icon-star"></i><i class="icon-star"></i><i
                                                        class="icon-star"></i><em>5.0/5.0</em></span>
                                                <em>Published 54 minutes ago</em>
                                            </div>
                                            <h4>"Commpletely satisfied"</h4>
                                            <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea.
                                                Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere
                                                fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer
                                                petentium cu his.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i
                                                        class="icon-star"></i><i class="icon-star empty"></i><i
                                                        class="icon-star empty"></i><em>4.0/5.0</em></span>
                                                <em>Published 1 day ago</em>
                                            </div>
                                            <h4>"Always the best"</h4>
                                            <p>Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere
                                                fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer
                                                petentium cu his.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="row justify-content-between">
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i
                                                        class="icon-star"></i><i class="icon-star"></i><i
                                                        class="icon-star empty"></i><em>4.5/5.0</em></span>
                                                <em>Published 3 days ago</em>
                                            </div>
                                            <h4>"Outstanding"</h4>
                                            <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea.
                                                Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere
                                                fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer
                                                petentium cu his.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i
                                                        class="icon-star"></i><i class="icon-star"></i><i
                                                        class="icon-star"></i><em>5.0/5.0</em></span>
                                                <em>Published 4 days ago</em>
                                            </div>
                                            <h4>"Excellent"</h4>
                                            <p>Sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius
                                                essent fuisset ut. Viderer petentium cu his.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                                <p class="text-end"><a href="{{ route('product.review') }}" class="btn_1">Leave a
                                        review</a></p>
                            </div> --}}
                            <!-- /card-body -->
                        </div>
                    </div>
                    <!-- /tab B -->
                </div>
                <!-- /tab-content -->
            </div>
            <!-- /container -->
        </div>
        <!-- /tab_content_wrapper -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Sản phẩm liên quan</h2>
                <span>Sản phẩm</span>
            </div>
            <div class="owl-carousel owl-theme products_carousel">
                @foreach ($relatedProduct as $item)
                    <div class="item">
                        <div class="grid_item">
                            @if ($item->is_featured)
                                <span class="ribbon off">Hot</span>
                            @endif

                            <figure>
                                <a href="{{ route('product.detail', $item->slug) }}">
                                    <img class="owl-lazy" src="{{ \Storage::url($item->thumbnail) }}"
                                        data-src="{{ \Storage::url($item->thumbnail) }}" alt="{{ $item->name }}">
                                </a>
                            </figure>
                            {{-- <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                        </div> --}}
                            <a href="{{ route('product.detail', $product->slug) }}">
                                <h3>{{ $item->name }}</h3>
                            </a>
                            <div class="price_box">
                                @if ($item->sale_price)
                                    <span class="new_price">{{ number_format($item?->sale_price) . 'đ' }}</span>
                                @endif

                                <span class="old_price">{{ number_format($item->regular_price) . 'đ' }}</span>
                            </div>
                            <ul>
                                {{-- <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a>
                            </li> --}}
                                {{-- <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to
                                        compare</span></a></li> --}}
                                <li><a href="{{ route('product.detail', $item->slug) }}" class="tooltip-1"
                                        data-bs-toggle="tooltip" data-bs-placement="left" title="Thêm vào giỏ hàng"><i
                                            class="ti-shopping-cart"></i><span>Thêm vào giỏ hàng</span></a></li>
                            </ul>
                        </div>
                        <!-- /grid_item -->
                    </div>
                    <!-- /item -->
                @endforeach
            </div>
            <!-- /products_carousel -->
        </div>
        <!-- /container -->

        <div class="feat">
            <div class="container">
                <ul>
                    <li>
                        <div class="box">
                            <i class="ti-gift"></i>
                            <div class="justify-content-center">
                                <h3>Quà tặng miễn phí</h3>
                                <p>Cho đơn hàng từ 200K</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="box">
                            <i class="ti-wallet"></i>
                            <div class="justify-content-center">
                                <h3>Thanh toán bảo mật</h3>
                                <p>100% thanh toán bảo mật</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="box">
                            <i class="ti-headphone-alt"></i>
                            <div class="justify-content-center">
                                <h3>Hỗ trợ 24/7</h3>
                                <p>Hỗ trợ online qua điện thoại</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!--/feat-->

    </main>
@endsection

@section('scripts')
	<script src="{{ asset('client\js\carousel_with_thumbs.js') }}"></script>
    <script>
        const variants = @json($variantsData);
        const attributes = @json($attributes->keys());
        let selectedAttributes = {};

        function initializeAttributes() {
            const container = document.getElementById('attribute-container');
            attributes.forEach(attribute => {
                const uniqueValues = [...new Set(variants.flatMap(v => Object.entries(v.attributes)
                    .filter(([key, _]) => key === attribute)
                    .map(([_, value]) => value)))];

                const div = document.createElement('div');
                div.className = 'form-group';
                div.innerHTML = `
					<div class="row">
                        <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>${attribute}</strong></label>
                        <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                            <div class="custom-select-form">
                                <select class="form-select wide attribute-select" name="attributes[${attribute}]" data-attribute="${attribute}" required>
                                    <option value="">Chọn ${attribute}</option>
										${uniqueValues.map(value => `<option value="${value}">${getAttributeValueById(attribute, value)}</option>`).join('')}
                                </select>
                            </div>
                        </div>
                    </div>
				`;
                container.appendChild(div);
            });
        }

        function updateAvailableOptions() {
            attributes.forEach(attribute => {
                const select = document.querySelector(`select[data-attribute="${attribute}"]`);
                const availableOptions = getAvailableOptions(attribute);

                Array.from(select.options).forEach(option => {
                    if (option.value) {
                        const isAvailable = availableOptions.some(ao => ao.id == option.value);
                        option.disabled = !isAvailable;
                        if (!isAvailable && option.selected) {
                            option.selected = false;
                            delete selectedAttributes[attribute];
                        }
                    }
                });
            });

            updateVariantInfo();
        }

        function getAvailableOptions(attribute) {
            return variants
                .filter(variant =>
                    Object.entries(selectedAttributes).every(([key, value]) =>
                        key === attribute || !value || variant.attributes[key] == value
                    )
                )
                .map(variant => ({
                    id: variant.attributes[attribute],
                    value: getAttributeValueById(attribute, variant.attributes[attribute])
                }))
                .filter((v, i, self) => self.findIndex(t => t.id === v.id) === i);
        }

        function getAttributeValueById(attribute, id) {
            const attributeValues = @json($attributes);
            const matchingValue = attributeValues[attribute].find(av => av.id == id);
            return matchingValue ? matchingValue.value : '';
        }

        function updateVariantInfo() {
            const selectedVariant = getSelectedVariant();
            const variantPrice = document.getElementById('variant-price');
            const variantRegularPrice = document.getElementById('variant-regular-price');
            const variantStock = document.getElementById('variant-stock');
            const addToCartBtn = document.getElementById('add-to-cart-btn');
            const variantIdInput = document.getElementById('variant_id');

            if (selectedVariant) {
                variantPrice.textContent = selectedVariant.sale_price.toLocaleString();
                variantRegularPrice.textContent = selectedVariant.regular_price.toLocaleString();
                variantStock.textContent = selectedVariant.stock;
                addToCartBtn.disabled = false;
                variantIdInput.value = selectedVariant.id;
            } else {
                variantPrice.textContent = 'N/A';
                variantRegularPrice.textContent = 'N/A';
                variantStock.textContent = 'N/A';
                addToCartBtn.disabled = true;
                variantIdInput.value = '';
            }
        }

        function getSelectedVariant() {
            return variants.find(variant =>
                attributes.every(attr => variant.attributes[attr] == selectedAttributes[attr])
            );
        }

        document.addEventListener('DOMContentLoaded', () => {
            initializeAttributes();

            document.getElementById('attribute-container').addEventListener('change', (event) => {
                if (event.target.classList.contains('attribute-select')) {
                    const attribute = event.target.getAttribute('data-attribute');
                    const value = event.target.value;

                    if (value) {
                        selectedAttributes[attribute] = value;
                    } else {
                        delete selectedAttributes[attribute];
                    }

                    updateAvailableOptions();
                }
            });

            document.getElementById('add-to-cart-form').addEventListener('submit', (event) => {
                event.preventDefault();
                const selectedVariant = getSelectedVariant();
                if (selectedVariant) {
                    event.target.submit();
                } else {
                    alert('Vui lòng chọn đầy đủ các thuộc tính sản phẩm.');
                }
            });

            updateAvailableOptions();
        });
    </script>
@endsection
