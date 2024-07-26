@extends('Clients.layout')
@section('title')
    Thông tin
@endsection
@section('stylesheets')
    <link href="{{ asset('client/css/about.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main class="bg_gray">
        <div class="container margin_60_35 add_bottom_30">
            <div class="main_title">
                <h2>Về Chúng Tôi </h2>
                <p>Allaia được thành lập với sứ mệnh mang đến những mẫu quần áo tốt nhất. Chúng tôi tự hào là một trong
                    những
                    người tiên phong trong lĩnh vực thời trang...</p>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-5">
                    <div class="box_about">
                        <h2>Cam kết</h2>
                        <p class="lead">Chúng tôi cam kết cung cấp các sản phẩm và dịch vụ chất
                            lượng cao, đáp ứng và vượt qua mong đợi của khách hàng.
                            Không ngừng đổi mớiđể mang lại những giải pháp tối ưu nhất.
                            Mọi hoạt động đều hướng đến việc đem lại giá trị cao nhất
                            cho khách hàng...
                        </p>
                        <img src="img/arrow_about.png" alt="" class="arrow_1">
                    </div>
                </div>
                <div class="col-lg-5 pl-lg-5 text-center d-none d-lg-block">
                    <img src="https://chuyennghiep.vn/upload/images/1(23).jpg" alt="" class="img-fluid"
                        width="560" height="375">
                </div>
            </div>
            <!-- /row -->
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-5 pr-lg-5 text-center d-none d-lg-block">
                    <img src="https://localbrand.vn/wp-content/uploads/2021/07/local-brand-va-chat-luong-san-pham.jpg"
                        alt="" class="img-fluid" width="300" height="268">
                </div>
                <div class="col-lg-5">
                    <div class="box_about">
                        <h2>Các brands hợp tác nổi bật</h2>
                        <p class="lead">Nhiều brand nổi tiếng được giới trẻ ưa thích.</p>
                        <p>Với nhiều brand hợp tác, chúng tôi có đa dạng các mẫu mã, luôn kịp thời cập nhật các xu hường mới
                            của thị trường.
                            Mang tới cho khách hàng trải nghiệm tốt nhất khi mua hàng tại Allaia.
                        </p>
                        <img src="img/arrow_about.png" alt="" class="arrow_2">
                    </div>
                </div>
            </div>
            <!-- /row -->
            <div class="row justify-content-center align-items-center ">
                <div class="col-lg-5">
                    <div class="box_about">
                        <h2>+5000 sản phẩm</h2>
                        <p class="lead">Đa dạng mẫu mã.</p>
                        <p>Không chỉ 1 mẫu quần áo cố định, chúng tôi cung cấp cho khách hàng đa dạng stye:
                            từ cá tính tới nhẹ nhàng, đơn giản mà vẫn thanh lịch. Tới với chúng tôi bạn sẽ không cần lo lắng
                            không chọn được mẫu mã ưng ý. Chúng tôi luôn cập nhật xu hướng thời trang mới nhất hiện nay.</p>
                    </div>

                </div>
                <div class="col-lg-5 pl-lg-5 text-center d-none d-lg-block">
                    <img src="https://cdn.chanhtuoi.com/uploads/2023/10/cac-local-brand-viet-nam-cho-nu-dottie.jpg"
                        alt="" class="img-fluid" width="350" height="316">
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

        <div class="bg_white">
            <div class="container margin_60_35">
                <div class="main_title">
                    <h2>Tại sao chọn Allaia</h2>
                    <p>Trang web thời trang luôn cung cấp các sản phẩm thời trang uy tín.</p>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="box_feat">
                            <i class="ti-medall-alt"></i>
                            <h3>+ 1000 Khách hàng</h3>
                            <p>Luôn được khách hàng tin tường sử dụng.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="box_feat">
                            <i class="ti-help-alt"></i>
                            <h3>Hỗ trợ 24h</h3>
                            <p>Hỗ trợ khách hàng 24/24. </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="box_feat">
                            <i class="ti-gift"></i>
                            <h3>Ưu đãi giảm giá lớn</h3>
                            <p>Rất nhiều ưu đãi lớn quanh năm.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="box_feat">
                            <i class="ti-headphone-alt"></i>
                            <h3>
                                Đường dây trợ giúp trực tiếp</h3>
                            <p>Luôn có nhân viên hotline tư vấn hỗ trợ. </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="box_feat">
                            <i class="ti-wallet"></i>
                            <h3>Thanh toán an toàn</h3>
                            <p>Hình thức thanh toán đa dạng.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="box_feat">
                            <i class="ti-comments"></i>
                            <h3>Hỗ trợ qua Trò chuyện</h3>
                            <p>Nhân viên hỗ trợ tư vấn sản phẩm. </p>
                        </div>
                    </div>
                </div>
                <!--/row-->
            </div>
        </div>
        <!-- /bg_white -->

        <div class="container margin_60">
            <div class="main_title">
                <h2>Gặp gỡ nhân viên Allaia</h2>
                <p>Những người có thâm niên kì cự trong lãnh vực thời trang</p>.</p>
            </div>
            <div class="owl-carousel owl-theme carousel_centered">
                <div class="item">
                    <a href="#0">
                        <div class="title">
                            <h4>Julia Holmes<em>CEO</em></h4>
                        </div><img src="https://dony.vn/wp-content/uploads/2021/08/ky-nang-ban-quan-ao.jpg" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="#0">
                        <div class="title">
                            <h4>Lucas Smith<em>Nhân viên tư vấn</em></h4>
                        </div><img src="https://dony.vn/wp-content/uploads/2021/08/kinh-nghiem-nhan-vien-ban-quan-ao-3.jpg" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="#0">
                        <div class="title">
                            <h4>Paul Stephens<em>Nhân viên tư vấn</em></h4>
                        </div><img src="https://blog.maybanhang.net/hs-fs/hubfs/Mai%20Linh/th%E1%BB%9Di%20trang/kinh-doanh-thoi-trang-1.jpg?width=650&name=kinh-doanh-thoi-trang-1.jpg" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="#0">
                        <div class="title">
                            <h4>Pablo Himenez<em>Nhân viên tư vấn</em></h4>
                        </div><img src="img/staff/4_carousel.jpg" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="#0">
                        <div class="title">
                            <h4>Andrew Stuttgart<em>Nhân viên tư vấn</em></h4>
                        </div><img src="https://static.chotot.com/storage/chotot-kinhnghiem/c2c/2020/12/viec-lam-ban-shop-quan-ao-tphcm-2.jpg" alt="">
                    </a>
                </div>
            </div>
            <!-- /carousel -->
        </div>
        <!-- /container -->
    </main>
    <!--/main-->
@endsection
