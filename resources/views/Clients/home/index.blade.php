
@extends('Clients.layout')
@section('title')
Trang chủ
@endsection
@section('stylesheets')
<link href="{{ asset('client/css/home_1.css')}}" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{ asset('client/js/carousel-home.min.js')}}"></script>
@endsection
@section('content')
	<main>
		<div id="carousel-home">
			<div class="owl-carousel owl-theme">
				<div class="owl-slide cover" style="background-image: url(img/slides/slide_home_2.jpg);">
					<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<div class="container">
							<div class="row justify-content-center justify-content-md-end">
								<div class="col-lg-6 static">
									<div class="slide-text text-end white">
										<h2 class="owl-slide-animated owl-slide-title">Attack Air<br>Max 720 Sage Low</h2>
										<p class="owl-slide-animated owl-slide-subtitle">
											Limited items available at this price
										</p>
										<div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/owl-slide-->
				<div class="owl-slide cover" style="background-image: url({{ asset('client/img/slides/slide_home_1.jpg')}});">
					<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<div class="container">
							<div class="row justify-content-center justify-content-md-start">
								<div class="col-lg-6 static">
									<div class="slide-text white">
										<h2 class="owl-slide-animated owl-slide-title">Attack Air<br>VaporMax Flyknit 3</h2>
										<p class="owl-slide-animated owl-slide-subtitle">
											Limited items available at this price
										</p>
										<div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/owl-slide-->
				<div class="owl-slide cover" style="background-image: url(img/slides/slide_home_3.jpg);">
					<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(255, 255, 255, 0.5)">
						<div class="container">
							<div class="row justify-content-center justify-content-md-start">
								<div class="col-lg-12 static">
									<div class="slide-text text-center black">
										<h2 class="owl-slide-animated owl-slide-title">Attack Air<br>Monarch IV SE</h2>
										<p class="owl-slide-animated owl-slide-subtitle">
											Lightweight cushioning and durable support with a Phylon midsole
										</p>
										<div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/owl-slide-->
				</div>
			</div>
			<div id="icon_drag_mobile"></div>
		</div>
		<!--/carousel-->

		<ul id="banners_grid" class="clearfix">
			<li>
				<a href="#0" class="img_container">
					<img src="{{asset('client/img/banners_cat_placeholder.jpg')}}" data-src="{{asset('client/img/banner_1.jpg')}}" alt="" class="lazy">
					<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<h3>Men's Collection</h3>
						<div><span class="btn_1">Shop Now</span></div>
					</div>
				</a>
			</li>
			<li>
				<a href="#0" class="img_container">
					<img src="img/banners_cat_placeholder.jpg" data-src="img/banner_2.jpg" alt="" class="lazy">
					<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<h3>Womens's Collection</h3>
						<div><span class="btn_1">Shop Now</span></div>
					</div>
				</a>
			</li>
			<li>
				<a href="#0" class="img_container">
					<img src="img/banners_cat_placeholder.jpg" data-src="img/banner_3.jpg" alt="" class="lazy">
					<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<h3>Kids's Collection</h3>
						<div><span class="btn_1">Shop Now</span></div>
					</div>
				</a>
			</li>
		</ul>
		<!--/banners_grid -->
		
		<div class="container margin_60_35">
			<div class="main_title">
				<h2>Top Selling</h2>
				<span>Products</span>
				<p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
			</div>
			<div class="row small-gutters">
				{{-- @foreach($products['most_viewed'] as $product)
				<div class="col-6 col-md-4 col-xl-3">
					<div class="grid_item">
						<figure>
							<span class="ribbon off">-30%</span>
							<a href="">
								<img class="img-fluid lazy" src="{{\Storage::url($product->thumbnail)}}" data-src="{{\Storage::url($product->thumbnail)}}" alt="{{ $product->name }}" width="290px" height="290px">
								<img class="img-fluid lazy" src="{{\Storage::url($product->thumbnail)}}" data-src="{{\Storage::url($product->thumbnail)}}" alt="{{ $product->name }}" width="290px" height="290px">
							</a>
						</figure>
						<div class="rating">
							@for ($i = 0; $i < 5; $i++)
								<i class="icon-star voted"></i>
							@endfor
						</div>
						<a href="">
							<h3>{{ $product->name }}</h3>
						</a>
						<div class="price_box">
							@if($product->sale_price)
								<span class="new_price">{{ $product->sale_price }}</span>
								<span class="old_price">{{ $product->regular_price }}</span>
							@else
								<span class="new_price">{{ $product->regular_price }}</span>
							@endif
						</div>
						<ul>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
						</ul>
					</div>
					<!-- /grid_product -->
				</div>
				<!-- /col -->
				@endforeach --}}
		
				@foreach($products['newest'] as $product)
				<div class="col-6 col-md-4 col-xl-3">
					<div class="grid_item">
						<span class="ribbon new">New</span>
						<figure>
							<a href="">
								<img class="img-fluid lazy" src="{{\Storage::url($product->thumbnail)}}" data-src="{{\Storage::url($product->thumbnail)}}" alt="{{ $product->name }}" width="290px" height="290px">
								<img class="img-fluid lazy" src="{{\Storage::url($product->thumbnail)}}" data-src="{{\Storage::url($product->thumbnail)}}" alt="{{ $product->name }}" width="290px" height="290px">
							</a>
						</figure>
						<div class="rating">
							@for ($i = 0; $i < 5; $i++)
								<i class="icon-star voted"></i>
							@endfor
						</div>
						<a href="">
							<h3>{{ $product->name }}</h3>
						</a>
						<div class="price_box">
							@if($product->sale_price)
								<span class="new_price">{{ $product->sale_price }}</span>
								<span class="old_price">{{ $product->regular_price }}</span>
							@else
								<span class="new_price">{{ $product->regular_price }}</span>
							@endif
						</div>
						<ul>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
						</ul>
					</div>
					<!-- /grid_item -->
				</div>
				<!-- /col -->
				@endforeach
		
				{{-- @foreach($products['featured'] as $product)
				<div class="col-6 col-md-4 col-xl-3">
					<div class="grid_item">
						<span class="ribbon hot">Hot</span>
						<figure>
							<a href="">
								<img class="img-fluid lazy" src="{{\Storage::url($product->thumbnail)}}" data-src="{{\Storage::url($product->thumbnail)}}" alt="{{ $product->name }}" width="290px" height="290px">
								<img class="img-fluid lazy" src="{{\Storage::url($product->thumbnail)}}" data-src="{{\Storage::url($product->thumbnail)}}" alt="{{ $product->name }}" width="290px" height="290px">
							</a>
						</figure>
						<div class="rating">
							@for ($i = 0; $i < 5; $i++)
								<i class="icon-star voted"></i>
							@endfor
						</div>
						<a href="">
							<h3>{{ $product->name }}</h3>
						</a>
						<div class="price_box">
							@if($product->sale_price)
								<span class="new_price">{{ $product->sale_price }}</span>
								<span class="old_price">{{ $product->regular_price }}</span>
							@else
								<span class="new_price">{{ $product->regular_price }}</span>
							@endif
						</div>
						<ul>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
						</ul>
					</div>
					<!-- /grid_item -->
				</div>
				<!-- /col -->
				@endforeach --}}
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->

		<div class="featured lazy" data-bg="url(img/featured_home.jpg)">
			<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
				<div class="container margin_60">
					<div class="row justify-content-center justify-content-md-start">
						<div class="col-lg-6 wow" data-wow-offset="150">
							<h3>Armor<br>Air Color 720</h3>
							<p>Lightweight cushioning and durable support with a Phylon midsole</p>
							<div class="feat_text_block">
								<div class="price_box">
									<span class="new_price">$90.00</span>
									<span class="old_price">$170.00</span>
								</div>
								<a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /featured -->

		<div class="container margin_60_35">
			<div class="main_title">
				<h2>Featured</h2>
				<span>Products</span>
				<p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
			</div>
			<div class="owl-carousel owl-theme products_carousel">
				@foreach ($featuredProductstop as $product)
					<div class="item">
						<div class="grid_item">
							
								<span class="ribbon hot">Hot</span>
							
							<figure>
								<a href="{{ route('product.detail', $product->slug) }}">
									<img class="owl-lazy" src="{{ asset('storage/' . $product->thumbnail) }}" data-src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" width="290px" height="290px">
								</a>
							</figure>
							<div class="rating">
								<!-- Assuming you have a rating field or method -->
								@for ($i = 0; $i < 5; $i++)
									<i class="icon-star voted"></i>
								@endfor
							</div>
							<a href="{{ route('product.detail', $product->slug) }}">
								<h3>{{ $product->name }}</h3>
							</a>
							<div class="price_box">
								@if($product->sale_price)
									<span class="new_price">${{ number_format($product->sale_price, 2) }}</span>
									<span class="old_price">${{ number_format($product->regular_price, 2) }}</span>
								@else
									<span class="new_price">${{ number_format($product->regular_price, 2) }}</span>
								@endif
							</div>
							<ul>
								<li><a href="#" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
								<li><a href="#" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
								<li><a href="#" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
							</ul>
						</div>
						<!-- /grid_item -->
					</div>
					<!-- /item -->
				@endforeach
			</div>
			<!-- /owl-carousel -->
			<!-- /products_carousel -->
		</div>
		<div class="container margin_60_35">
			<div class="main_title">
				<h2>Best Sale</h2>
				<span>Products</span>
				<p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
			</div>
			<div class="owl-carousel owl-theme products_carousel">
				@foreach ($products['most_viewed'] as $product)
					<div class="item">
						<div class="grid_item">
							
								<span class="ribbon off">Sale</span>
							
							<figure>
								<a href="{{ route('product.detail', $product->slug) }}">
									<img class="owl-lazy" src="{{ asset('storage/' . $product->thumbnail) }}" data-src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" width="290px" height="290px">
								</a>
							</figure>
							<div class="rating">
								<!-- Assuming you have a rating field or method -->
								@for ($i = 0; $i < 5; $i++)
									<i class="icon-star voted"></i>
								@endfor
							</div>
							<a href="{{ route('product.detail', $product->slug) }}">
								<h3>{{ $product->name }}</h3>
							</a>
							<div class="price_box">
								@if($product->sale_price)
									<span class="new_price">${{ number_format($product->sale_price, 2) }}</span>
									<span class="old_price">${{ number_format($product->regular_price, 2) }}</span>
								@else
									<span class="new_price">${{ number_format($product->regular_price, 2) }}</span>
								@endif
							</div>
							<ul>
								<li><a href="#" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
								<li><a href="#" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
								<li><a href="#" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
							</ul>
						</div>
						<!-- /grid_item -->
					</div>
					<!-- /item -->
				@endforeach
			</div>
			<!-- /owl-carousel -->
			<!-- /products_carousel -->
		</div>
		<!-- /container -->
		
		<div class="bg_gray">
			<div class="container margin_30">
				<div id="brands" class="owl-carousel owl-theme">
					<div class="item">
						<a href="#0"><img src="{{asset('client/img/brands/logo_1.png')}}" data-src="{{asset('client/img/brands/logo_1.png')}}" alt="" class="owl-lazy"></a>
					</div><!-- /item -->
					<div class="item">
						<a href="#0"><img src="{{asset('client/img/brands/logo_2.png')}}" data-src="{{asset('client/img/brands/logo_2.png')}}" alt="" class="owl-lazy"></a>
					</div><!-- /item -->
					<div class="item">
						<a href="#0"><img src="{{asset('client/img/brands/logo_3.png')}}" data-src="{{asset('client/img/brands/logo_3.png')}}" alt="" class="owl-lazy"></a>
					</div><!-- /item -->
					<div class="item">
						<a href="#0"><img src="{{asset('client/img/brands/logo_4.png')}}" data-src="{{asset('client/img/brands/logo_4.png')}}" alt="" class="owl-lazy"></a>
					</div><!-- /item -->
					<div class="item">
						<a href="#0"><img src="{{asset('client/img/brands/logo_5.png')}}" data-src="{{asset('client/img/brands/logo_5.png')}}" alt="" class="owl-lazy"></a>
					</div><!-- /item -->
					<div class="item">
						<a href="#0"><img src="{{asset('client/img/brands/logo_6.png')}}" data-src="{{asset('client/img/brands/logo_6.png')}}" alt="" class="owl-lazy"></a>
					</div><!-- /item --> 
				</div><!-- /carousel -->
			</div><!-- /container -->
		</div>
		<!-- /bg_gray -->

		<div class="container margin_60_35">
			<div class="main_title">
				<h2>Latest News</h2>
				<span>Blog</span>
				<p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<a class="box_news" href="blog.html">
						<figure>
							<img src="https://lavenderstudio.com.vn/wp-content/uploads/2021/06/cach-chup-hinh-san-pham-quan-ao-dep-2.png" data-src="https://lavenderstudio.com.vn/wp-content/uploads/2021/06/cach-chup-hinh-san-pham-quan-ao-dep-2.png" alt="" width="400" height="266" class="lazy">
							<figcaption><strong>28</strong>Dec</figcaption>
						</figure>
						<ul>
							<li>by Mark Twain</li>
							<li>20.11.2017</li>
						</ul>
						<h4>Pri oportere scribentur eu</h4>
						<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
					</a>
				</div>
				<!-- /box_news -->
				<div class="col-lg-6">
					<a class="box_news" href="blog.html">
						<figure>
							<img src="https://resource.nhuahvt.com/0x0/tmp/chup-anh-san-pham-phang-1596647399.jpg" data-src="https://resource.nhuahvt.com/0x0/tmp/chup-anh-san-pham-phang-1596647399.jpg" alt="" width="400" height="266" class="lazy">
							<figcaption><strong>28</strong>Dec</figcaption>
						</figure>
						<ul>
							<li>By Jhon Doe</li>
							<li>20.11.2017</li>
						</ul>
						<h4>Duo eius postea suscipit ad</h4>
						<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
					</a>
				</div>
				<!-- /box_news -->
				<div class="col-lg-6">
					<a class="box_news" href="blog.html">
						<figure>
							<img src="https://img.ws.mms.shopee.vn/008d7e1f9a3d39ae9d6a7cc09a6c3233" data-src="https://img.ws.mms.shopee.vn/008d7e1f9a3d39ae9d6a7cc09a6c3233" alt="" width="400" height="266" class="lazy">
							<figcaption><strong>28</strong>Dec</figcaption>
						</figure>
						<ul>
							<li>By Luca Robinson</li>
							<li>20.11.2017</li>
						</ul>
						<h4>Elitr mandamus cu has</h4>
						<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
					</a>
				</div>
				<!-- /box_news -->
				<div class="col-lg-6">
					<a class="box_news" href="blog.html">
						<figure>
							<img src="https://blog.dktcdn.net/files/cach-chup-san-pham-quan-ao-ban-hang-3.jpg" data-src="https://blog.dktcdn.net/files/cach-chup-san-pham-quan-ao-ban-hang-3.jpg" alt="" width="400" height="266" class="lazy">
							<figcaption><strong>28</strong>Dec</figcaption>
						</figure>
						<ul>
							<li>By Paula Rodrigez</li>
							<li>20.11.2017</li>
						</ul>
						<h4>Id est adhuc ignota delenit</h4>
						<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
					</a>
				</div>
				<!-- /box_news -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</main>
	<!-- /main -->
	@endsection	
	