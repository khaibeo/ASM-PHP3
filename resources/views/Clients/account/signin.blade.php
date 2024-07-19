@extends('Clients.layout')
@section('title')
    Đăng nhập và đăng ký
@endsection
@section('stylesheets')
    <link href="{{ asset('client/css/account.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main class="bg_gray">

        <div class="container margin_30">
            <div class="page_header">
                {{-- <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li>Page active</li>
                    </ul>
                </div> --}}
                <h1>Đăng nhập hoặc đăng ký tài khoản</h1>
            </div>
            <!-- /page_header -->
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-8">
                    <div class="box_account">
                        <h3 class="client">Đã có tài khoản</h3>
                        <div class="form_container">
                            <div class="row no-gutters">
                                <div class="col-lg-6 pr-lg-1">
                                    <a href="#0" class="social_bt facebook">Đăng nhập với Facebook</a>
                                </div>
                                <div class="col-lg-6 pl-lg-1">
                                    <a href="#0" class="social_bt google">Đăng nhập với Google</a>
                                </div>
                            </div>
                            <div class="divider"><span>Hoặc</span></div>
                            <form action="{{ route('auth.login') }}" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="Email*">
										@error('email')
											<span class="text-danger d-block mt-3">{{ $message }}</span>
										@enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password"
                                        value="" placeholder="Mật khẩu*">
										@error('password')
										<span class="text-danger d-block mt-3">{{ $message }}</span>
									@enderror
                                </div>
                                <div class="clearfix add_bottom_15">
                                    <div class="checkboxes float-start">
                                        <label class="container_check">Tự động đăng nhập
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="float-end"><a id="forgot" href="javascript:void(0);">Quên mật khẩu?</a>
                                    </div>
                                </div>
                                <div class="text-center"><input type="submit" value="Đăng nhập" class="btn_1 full-width">
                                </div>
								@csrf
                            </form>
                            <div id="forgot_pw">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email_forgot" id="email_forgot"
                                        placeholder="Nhập email để lấy lại mật khẩu">
                                </div>
                                <p>Mật khẩu mới sẽ được gửi vào email.</p>
                                <div class="text-center"><input type="submit" value="Lấy lại mật khẩu" class="btn_1"></div>
                            </div>
                        </div>
                        <!-- /form_container -->
                    </div>
                    <!-- /box_account -->
                </div>
                <div class="col-xl-6 col-lg-6 col-md-8">
                    <div class="box_account">
                        <h3 class="new_client">Người dùng mới - đăng ký</h3> <small class="float-right pt-2">* bắt buộc phải nhập</small>
                        <form method="POST" action="{{route('auth.register')}}" class="form_container">
                            <div class="form-group">
                                <input type="text" class="form-control" name="email_register" id="email_2"
                                    placeholder="Email*">
									@error('email_register')
										<span class="text-danger d-block mt-3">{{ $message }}</span>
									@enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_register" id="password_in_2"
                                    value="" placeholder="Mật khẩu*">
									@error('password_register')
									<span class="text-danger d-block mt-3">{{ $message }}</span>
								@enderror
                            </div>
                            <hr>
							<div class="form-group">
                                <input type="text" class="form-control" name="name" id="name"
                                    value="" placeholder="Họ và tên*">
									@error('name')
									<span class="text-danger d-block mt-3">{{ $message }}</span>
								@enderror
                            </div>

							<div class="form-group">
                                <input type="text" class="form-control" name="phone" id="phone"
                                    value="" placeholder="Số điện thoại">
									@error('phone')
									<span class="text-danger d-block mt-3">{{ $message }}</span>
								@enderror
                            </div>

							<div class="form-group">
                                <input type="text" class="form-control" name="address" id="address"
                                    value="" placeholder="Địa chỉ">
                            </div>
                            
                            {{-- <hr>
                            <div class="form-group">
                                <label class="container_check">Accept <a href="#0">Terms and conditions</a>
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div> --}}
                            <div class="text-center"><input type="submit" value="Register" class="btn_1 full-width">
                            </div>
							@csrf
                        </form>
                        <!-- /form_container -->
                    </div>
                    <!-- /box_account -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!--/main-->
@endsection

@section('footer')
    <script>
        // Client type Panel
        $('input[name="client_type"]').on("click", function() {
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".box").not(targetBox).hide();
            $(targetBox).show();
        });
    </script>
@endsection
