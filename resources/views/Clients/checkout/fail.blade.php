@extends('Clients.layout')
@section('title')
Thanh toán thất bại
@endsection
@section('stylesheets')
<link href="{{ asset('client/css/checkout.css')}}" rel="stylesheet">
@endsection
@section('content')
<main class="bg_gray">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div id="confirm">
                    <div class="icon icon--order-failure svg add_bottom_15">
                        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
                            <g fill="none" stroke="#FF0000" stroke-width="2">
                                <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                <path d="M20,20 L52,52 M52,20 L20,52" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                            </g>
                        </svg>
                    </div>
                <h2>Thanh toán thất bại!</h2>
                <p>Đã có lỗi xảy ra trong quá trình thanh toán, vui lòng thử lại!</p>

                <div>
                    <a class="btn btn-warning mx-2" href="#">Thanh toán lại</a>
                </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
    
</main>
<!--/main-->
@endsection