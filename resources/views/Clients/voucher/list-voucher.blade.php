@extends('Clients.layout')
@section('title')
Voucher
@endsection
@section('stylesheets')
<link href="{{ asset('client/css/voucher.css')}}" rel="stylesheet">
@endsection
@section('content')
<main class="bg_gray">
    <div class="container">
        <div class="page">
           <img src="https://down-vn.img.susercontent.com/file/vn-11134258-7r98o-lxjiss9i08uxf4@resize_w960_nl.webp" width="100%" alt="">
           <h1>Danh Sách VouCher</h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="voucher-item">
                    <div class="voucher-details">
                        <h3>Giảm 10% tối đa 20k</h3>
                        <p>Số lượt sử dụng có hạn, chương trình và mã có thể kết thúc khi hết lượt ưu đãi hoặc khi hết hạn ưu đãi, tuỳ điều kiện nào đến trước.</p>
                        <p>Có hiệu lức từ ngày 15/7</p>
                    </div>
                    <div class="voucher-actions">
                        <button class="save-button">Lưu</button>
                    </div>
                </div>
                <div class="voucher-item">
                    <div class="voucher-details">
                        <h3>Giảm 10% tối đa 20k</h3>
                        <p>Số lượt sử dụng có hạn, chương trình và mã có thể kết thúc khi hết lượt ưu đãi hoặc khi hết hạn ưu đãi, tuỳ điều kiện nào đến trước.</p>
                        <p>Có hiệu lức từ ngày 15/7</p>
                    </div>
                    <div class="voucher-actions">
                        <button class="save-button">Lưu</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="voucher-item">
                    <div class="voucher-details">
                        <h3>FreeShip Tối Đa 15k</h3>
                        <p>Số lượt sử dụng có hạn, chương trình và mã có thể kết thúc khi hết lượt ưu đãi hoặc khi hết hạn ưu đãi, tuỳ điều kiện nào đến trước.</p>
                        <p>Có hiệu lức từ ngày 15/7</p>
                    </div>
                    <div class="voucher-actions">
                        <button class="save-button">Lưu</button>
                    </div>
                </div>
                <div class="voucher-item">
                    <div class="voucher-details">
                        <h3>Giảm 5%</h3>
                        <p>Mỗi tài khoản chỉ được sử dụng một lần duy nhất. Mã giảm giá phát hành bởi Người bán và sẽ không được hoàn lại với bất kỳ lý do nào..</p>
                        <p>Có hiệu lức từ ngày 15/7</p>
                    </div>
                    <div class="voucher-actions">
                        <button class="save-button">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
		
	</main>
	<!--/main-->
    @endsection