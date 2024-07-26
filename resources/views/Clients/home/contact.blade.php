@extends('Clients.layout')
@section('title')
 Liên hệ
@endsection
@section('stylesheets')
<link href="{{ asset('client/css/contact.css')}}" rel="stylesheet">
@endsection
@section('content')

<main class="bg_gray">
	
    <div class="container margin_60">
        <div class="main_title">
            <h2>Liên hệ Allaia</h2>
            <p>Chúng tôi luôn sẵn sàng lăng nghe những đóng góp, ý kiến của bạn.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="box_contacts">
                    <i class="ti-support"></i>
                    <h2>Trung tâm trợ giúp Allaia</h2>
                    <a href="#0">+84 123-456-789</a> - <a href="#0">help@allaia.com</a>
                    <small>Các ngày trong tuần</small>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="box_contacts">
                    <i class="ti-map-alt"></i>
                    <h2>Địa chi</h2>
                    <div>Trịnh Văn Bô - Nam Từ Liêm - Hà Nội</div>
                    <small>Thứ 2 - Thứ 7</small>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="box_contacts">
                    <i class="ti-package"></i>
                    <h2>Đơn hàng</h2>
                    <a href="#0">+94 423-231-221</a> - <a href="#0">order@allaia.com</a>
                    <small>Thứ 2 - Thứ 7</small>
                </div>
            </div>
        </div>
        <!-- /row -->				
    </div>
    <!-- /container -->
<div class="bg_white">
    <div class="container margin_60_35">
        <h4 class="pb-3">Nói với chúng tôi về vấn đề của bạn</h4>
        <div class="row">
            <div class="col-lg-4 col-md-6 add_bottom_25">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Họ tên *">
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" placeholder="Email *">
                </div>
                <div class="form-group">
                    <textarea class="form-control" style="height: 150px;" placeholder="Ghi chú *"></textarea>
                </div>
                <div class="form-group">
                    <input class="btn_1 full-width" type="submit" value="Gửi">
                </div>
            </div>
            <div class="col-lg-8 col-md-6 add_bottom_25">
            <iframe class="map_contact" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39714.47749917409!2d-0.13662037019554393!3d51.52871971170425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondra%2C+Regno+Unito!5e0!3m2!1sit!2ses!4v1557824540343!5m2!1sit!2ses" style="border: 0" allowfullscreen></iframe>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /bg_white -->
</main>
<!--/main-->
@endsection