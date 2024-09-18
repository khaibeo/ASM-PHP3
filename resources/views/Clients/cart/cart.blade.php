@extends('Clients.layout')
@section('title')
    Giỏ hàng
@endsection
@section('stylesheets')
    <link href="{{ asset('client/css/cart.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
                        {{-- <li><a href="#">Danh mục</a></li> --}}
                        <li>Giỏ hàng</li>
                    </ul>
                </div>
                <h1>Giỏ hàng của tôi</h1>
            </div>

            @session('success')
                <div class="alert alert-success">{{ session('success') }}</div>
            @endsession

            @session('error')
                <div class="alert alert-success">{{ session('error') }}</div>
            @endsession
            <!-- /page_header -->
            @if ($cartItems->count() > 0)
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr id="cart-item-{{ $item->id }}" data-item-id="{{ $item->id }}">
                                <td>
                                    <a class="text-dark" href="{{ route('product.detail', $item->variant->product->slug) }}">
                                    <div class="thumb_cart">
                                        <img src="{{ \Storage::url($item->variant->product->thumbnail) }}"
                                            data-src="{{ \Storage::url($item->variant->product->thumbnail) }}"
                                            class="lazy" alt="Image">
                                    </div>
                                    <span class="item_cart fs-6 text-decoration-underline">{{ $item->variant->product->name }}</span>
                                    <span class="item_cart mt-2">{{ $item->variantAttributes }}</span>
                                    </a>
                                </td>
                                <td>
                                    @if ($item->variant->sale_price)
                                        <strong>{{ number_format($item->variant->sale_price) . ' đ' }}
                                            <del>{{ number_format($item->variant->regular_price) . ' đ' }}</del></strong>
                                    @else
                                        <strong>{{ number_format($item->variant->regular_price) . ' đ' }}</strong>
                                    @endif
                                </td>
                                <td>
                                    <div class="numbers-row">
                                        <input type="text" value="{{ $item->quantity }}"
                                            id="quantity_{{ $item->id }}" class="qty2"
                                            name="quantity_{{ $item->id }}" data-item-id="{{ $item->id }}">
                                        <div class="inc button_inc">+</div>
                                        <div class="dec button_inc">-</div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $price = $item->variant->sale_price ?? $item->variant->regular_price;
                                    @endphp
                                    <strong class="item-total"
                                        id="item-total-{{ $item->id }}">{{ number_format($price * $item->quantity) . ' đ' }}</strong>

                                </td>
                                <td class="options">
                                    <a href="#" class="remove-item" data-item-id="{{ $item->id }}"><i
                                            class="ti-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        <!-- /container -->

        <div class="box_cart">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <ul>
                            <li>
                                <span>Thành tiền</span> <strong id="cart-total">{{ number_format($total) . 'đ' }}</strong>
                            </li>
                        </ul>
                        <a href="{{ route('checkout.index') }}" class="btn_1 full-width cart">Mua hàng</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="d-flex justify-content-center align-items-center py-5">
            <div class="py-5 text-center">
                <p class="fs-6">Giỏ hàng của bạn đang trống.</p>
                <a href="#" class="btn btn-primary">Xem sản phẩm</a>
            </div>
        </div>
        @endif
        <!-- /box_cart -->

    </main>
    <!--/main-->
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Xử lý sự kiện thay đổi số lượng
            $('.numbers-row').each(function() {
                var $row = $(this);
                var $input = $row.find('input.qty2');
                var $inc = $row.find('.inc');
                var $dec = $row.find('.dec');

                $inc.on('click', function() {
                    var value = parseInt($input.val(), 10);
                    
                    $input.val(value).trigger('change');
                });

                $dec.on('click', function() {
                    var value = parseInt($input.val(), 10);
                    if (value > 0) {
                        $input.val(value).trigger('change');
                    }
                });

                $input.on('change', function() {
                    var itemId = $(this).data('item-id');
                    var quantity = $(this).val();
                    updateCartItem(itemId, quantity);
                });
            });

            function updateCartItem(itemId, quantity) {
                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        item_id: itemId,
                        quantity: quantity
                    },
                    success: function(response) {
                        $('#item-total-' + itemId).text(response.itemTotal);
                        $('#cart-total').text(response.total);
                    },
                    error: function(xhr) {
                        // console.error('Error:', xhr);
                        alert('Có lỗi xảy ra khi cập nhật số lượng. Vui lòng thử lại sau.');
                    }
                });
            }

            // Xóa sản phẩm
            $('.remove-item').on('click', function(e) {
                e.preventDefault();
                var itemId = $(this).data('item-id');

                let confirm = window.confirm('Bạn có chắc là muốn xóa ?');
                if (confirm) {
                    removeCartItem(itemId);
                }
            });

            function removeCartItem(itemId) {
                $.ajax({
                    url: '{{ route('cart.remove') }}',
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        item_id: itemId
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#cart-item-' + itemId).remove();
                            $('#cart-total').text(response.total);
                            if ($('.cart-list tbody tr').length === 0) {
                                location.reload();
                            }
                        } else {
                            alert(response.message || 'Có lỗi xảy ra khi xóa sản phẩm.');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        alert('Có lỗi xảy ra khi xóa sản phẩm. Vui lòng thử lại sau.');
                    }
                });
            }
        });
    </script>
@endsection
