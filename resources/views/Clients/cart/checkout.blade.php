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
                        <li><a href="#">Trang Chủ</a></li>
                        <li><a href="#">Loại</a></li>
                        <li>Trang Đang Hoạt Động</li>
                    </ul>
                </div>
                <h1>Đăng nhập hoặc tạo một tài khoản</h1>

            </div>
            <!-- /page_header -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="step first">
                        <h3>1. Thông tin người dùng và địa chỉ thanh toán</h3>
                        <ul class="nav nav-tabs" id="tab_checkout" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#tab_1" role="tab"
                                    aria-controls="tab_1" aria-selected="true">Thông Tin Người Dùng</a>
                            </li>
                        </ul>
                        <div class="tab-content checkout">
                            <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Mật Khẩu">
                                </div>
                                <hr>
                                <div class="row no-gutters">
                                    <div class="col-6 form-group pr-1">
                                        <input type="text" class="form-control" placeholder="Tên">
                                    </div>
                                    <div class="col-6 form-group pl-1">
                                        <input type="text" class="form-control" placeholder="Họ">
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Địa Chỉ">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Thành Phố">
                                </div>


                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Số Điện Thoại">
                                </div>
                                <hr>
                                <input type="submit" class="btn_1 full-width" value="Cập Nhật">
                            </div>
                            <!-- /tab_1 -->
                            <!-- /tab_2 -->
                        </div>
                    </div>
                    <!-- /step -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step middle payments">
                        <h3>2. Thanh toán và Vận chuyển</h3>
                        <ul>
                            <li>
                                <label class="container_radio">Thẻ Tín Dụng<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="payment" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Paypal<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Thanh Toán Khi Giao Hàng<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        </ul>
                        <div class="payment_info d-none d-sm-block">
                            <figure><img src="{{ asset('client/img/cards_all.svg') }}" alt=""></figure>
                            <p>Nó nên được hiểu là sự co rút của các giác quan, để lỗi lầm của chúng tôi và của bạn đều
                                không phải là một triết lý tốt hơn. Nhưng hầu như không có nguy hiểm gì. Thông thường
                                tritani lúc đầu không phải là những định nghĩa đó.</p>
                        </div>

                        <h6 class="pb-2">Phương Pháp Vận Chuyển</h6>


                        <ul>
                            <li>
                                <label class="container_radio">Vận Chuyển Tiêu Chuẩn<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="shipping" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Vận Chuyển Hỏa Tốc<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="shipping">
                                    <span class="checkmark"></span>
                                </label>
                            </li>

                        </ul>

                    </div>
                    <!-- /step -->

                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step last">
                        <h3>3. Tóm tắt đơn hàng</h3>
                        <div class="box_general summary">
                            <ul>
                                <li class="clearfix"><em>1x Armor Air X Fear</em> <span>$145.00</span></li>
                                <li class="clearfix"><em>2x Armor Air Zoom Alpha</em> <span>$115.00</span></li>
                            </ul>
                            <ul>
                                <li class="clearfix"><em><strong>Tổng cộng</strong></em> <span>$450.00</span></li>
                                <li class="clearfix"><em><strong>Vận chuyển</strong></em> <span>$0</span></li>
                            </ul>
							<div class="form-group">
								<label for="discount_code">Mã Giảm Giá:</label>
								<div class="d-flex align-items-center">
								  <input type="text" id="discount_code" name="discount_code" class="form-control" placeholder="Nhập mã giảm giá">
								  <button type="button" id="applyDiscountBtn" class="btn_1 ml-2">Áp Dụng</button>
								</div>
							  </div>
                            <div class="total clearfix">Tổng Đơn Hàng <span>$450.00</span></div>
                            <div class="form-group">
                                <label class="container_check">Đăng Ký Nhận Bản Tin.
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <a href="confirm.html" class="btn_1 full-width">Xác Nhận Và Thanh Toán</a>
                        </div>
                        <!-- /box_general -->
                    </div>
                    <!-- /step -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!--/main-->
@endsection
@section('scripts')
    <div class="modal fade" id="payments_method" tabindex="-1" role="dialog" aria-labelledby="payments_method_title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="payments_method_title">Phương Thức Thanh Toán</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tôi xin cảm ơn bạn rất nhiều. Tôi nói với anh ấy rằng tôi đã sẵn sàng làm việc. Ngay cả khi con vật
                        không tự hào về trí tuệ, thì quyền quảng cáo đúng đắn. Những người mà anh chưa biết đến đang co lại,
                        hiếm khi hình thành trên thực địa, câu hỏi từ chối sức mạnh tinh tế nhất đối với anh. Chúng tôi
                        không có câu chuyện để buộc tội..</p>
                    <p>Và vì anh ấy đã nhìn thấy Zril, trước khi anh ấy nghĩ ra rằng họ nên được nhận. Anh ấy khoe khoang về
                        hai điều nữa, nhưng, trước sức ép của nỗi đau, anh ấy đã trượt dốc hoàn toàn, tôi ước gì tất cả tôi
                        cũng trượt được điều đó. Liệu việc gọi anh ta có ích lợi gì không Cũng như khu rừng kia của tôi,
                        nhưng tôi hầu như không muốn đến, với kết luận của riêng mìn.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Other address Panel
        $('#other_addr input').on("change", function() {
            if (this.checked)
                $('#other_addr_c').fadeIn('fast');
            else
                $('#other_addr_c').fadeOut('fast');
        });
    </script>
@endsection
