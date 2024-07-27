@extends('Clients.layout')
@section('title')
    Thanh toán
@endsection
@section('stylesheets')
    <link href="{{ asset('client/css/checkout.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
                        <li><a href="{{ route('cart.index') }}">Giỏ hàng</a></li>
                        <li>Thanh toán</li>
                    </ul>
                </div>
                <h1>Thanh toán</h1>

            </div>
            @session('error')
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endsession
            <!-- /page_header -->
            <form action="{{ route('checkout.process') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="step first">
                            <h3>1. Thông tin nhận hàng</h3>
                            <div class="tab-content checkout p-0">
                                <div class="tab-pane fade show active" id="tab_1" role="tabpanel"
                                    aria-labelledby="tab_1">
                                    <div class="form-group">
                                        <label for="" class="form-label">Họ và tên</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $user->name) }}" placeholder="">
                                        @error('name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Email</label>
                                        <input type="email" value="{{ old('email', $user->email) }}" name="email"
                                            class="form-control" placeholder="">
                                        @error('email')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="text" value="{{ old('phone', $user->phone) }}" name="phone"
                                            class="form-control" placeholder="">
                                        @error('phone')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="form-label">Địa chỉ nhận hàng</label>
                                        <input type="text" name="address" class="form-control"
                                            value="{{ old('address', $user->address) }}" placeholder="Địa chỉ cụ thể">
                                        @error('address')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Lưu ý cho đơn hàng</label>
                                        <input type="text" name="note" value="{{ old('note') }}"
                                            class="form-control" placeholder="Lưu ý cho người bán">
                                    </div>
                                </div>
                                <!-- /tab_1 -->
                            </div>
                        </div>
                        <div class="step middle payments">
                            <h3>2. Phương thức thanh toán</h3>
                            <ul>
                                <li>
                                    <label class="container_radio">Thanh toán khi nhận hàng<a href="#0" class="info"
                                            data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                        <input type="radio" name="payment_method" value="0" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_radio">Thanh toán qua VN Pay<a href="#0" class="info"
                                            data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                        <input type="radio" value="1" name="payment_method"
                                            {{ old('payment_method') == 1 ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                @error('payment_method')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </ul>
                        </div>
                        <!-- /step -->
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="step last">
                            <h3>3. Tổng quan đơn hàng</h3>
                            <div class="box_general summary">
                                <ul>
                                    @foreach ($cartItems as $item)
                                        <li class="clearfix"><em>{{ $item->quantity }}x
                                                {{ $item->variant->product->name }} -
                                                {{ $item->variantAttributes }}</em>
                                            <span>{{ number_format($item->variant->sale_price ?? $item->variant->regular_price, 0, ',', '.') . ' đ' }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="input-group mb-3">
                                    <input type="text" value="" id="voucherCode" name="code"
                                        class="form-control" placeholder="Mã giảm giá" aria-label="Mã giảm giá"
                                        aria-describedby="applyVoucher">
                                    <button class="btn btn-primary" type="button" id="applyVoucher">Áp dụng</button>
                                </div>
                                <ul>
                                    <li class="clearfix"><em><strong>Tổng tiền</strong></em>
                                        <span>{{ number_format($total, 0, ',', '.') . ' đ' }}</span>
                                    </li>
                                    <li class="clearfix"><em><strong>Giảm giá</strong></em> <span id="discounted">0</span>
                                    </li>
                                    <li class="clearfix"><em><strong>Phí vận chuyển</strong></em> <span>Miễn phí</span>
                                    </li>
                                </ul>
                                <div class="total clearfix">Thành tiền <span
                                        id="subtotal">{{ number_format($total, 0, ',', '.') . ' đ' }}</span></div>
                                <input type="hidden" value="1" name="checkout">
                                <input type="hidden" value="0" name="voucher" id="voucher">
                                <input type="hidden" value="{{ $total }}" name="totalProduct" id="totalProduct">
                                <input type="hidden" value="0" name="discountedValue" id="discountedValue">
                                <input type="hidden" value="{{ $total }}" name="totalbill" id="totalbill">
                                <button type="submit" class="btn_1 full-width">Đặt hàng</button>
                            </div>
                            <!-- /box_general -->
                        </div>
                        <!-- /step -->
                    </div>
                </div>
            </form>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!--/main-->
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var currentVoucher = null;
            var originalTotal = parseFloat($('#totalbill').val().replace(/[^\d.-]/g, ''));

            $('#applyVoucher').on('click', function() {
                var voucherCode = $('#voucherCode').val();
                var total = currentVoucher ? originalTotal : parseFloat($('#totalbill').val().replace(
                    /[^\d.-]/g, ''));

                if (isNaN(total)) {
                    showAlert('error', 'Không thể xác định tổng tiền. Vui lòng tải lại trang.');
                    return;
                }

                $.ajax({
                    url: "{{route('checkVoucher')}}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        code: voucherCode,
                        total: total
                    },
                    success: function(response) {
                        if (response.valid) {
                            applyVoucher(response, total);
                        } else {
                            showAlert('error', response.message || 'Mã giảm giá không hợp lệ.');
                        }
                    },
                    error: function() {
                        showAlert('error', 'Có lỗi xảy ra. Vui lòng thử lại sau.');
                    }
                });
            });

            function applyVoucher(voucher, total) {
                var discountAmount = voucher.discount_type === 'percentage' ?
                    total * (voucher.discount_value / 100) :
                    voucher.discount_value;

                var newTotal = total - discountAmount;

                // Cập nhật giao diện
                $('#discounted').text(formatCurrency(discountAmount));
                $('#subtotal').text(formatCurrency(newTotal));
                $('#voucher').val(voucher.id);
                $('#discountedValue').val(discountAmount);
                $('#totalbill').val(newTotal);

                // Lưu voucher hiện tại
                currentVoucher = voucher;

                showAlert('success', 'Mã giảm giá đã được áp dụng thành công!');
            }

            function formatCurrency(amount) {
                return amount.toFixed(0).replace(/\d(?=(\d{3})+$)/g, '$&,') + ' ₫';
            }

            function showAlert(type, message) {
                var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
                var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                    message +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span></button></div>';

                $('.box_general.summary').prepend(alertHtml);

                // Tự động ẩn thông báo sau 5 giây
                setTimeout(function() {
                    $('.alert').alert('close');
                }, 5000);
            }
        });
    </script>
@endsection
