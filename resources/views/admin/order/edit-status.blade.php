@extends('admin.layout')

@section('title')
    Sửa Trạng Thái Đơn Hàng
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Sửa Trạng Thái Đơn Hàng</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Sửa Trạng Thái Đơn Hàng</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="order_status" class="form-label">Trạng Thái Đơn Hàng</label>
                                <select class="form-control" id="order_status" name="order_status">
                                    <option value="Chờ xử lý" {{ $order->order_status == 'Chờ xử lý' ? 'selected' : '' }} {{ $order->order_status == 'Giao hàng thành công' ? 'disabled' : '' }}>Chờ Xử Lý</option>
                                    <option value="Đang sử lý" {{ $order->order_status == 'Đang sử lý' ? 'selected' : '' }} {{ $order->order_status == 'Giao hàng thành công' ? 'disabled' : '' }}>Đang Xử Lý</option>
                                    <option value="Đã gửi cho đơn vị vận chuyển" {{ $order->order_status == 'Đã gửi cho đơn vị vận chuyển' ? 'selected' : '' }} {{ $order->order_status == 'Giao hàng thành công' ? 'disabled' : '' }}>Đã Gửi Cho Đơn Vị Vận Chuyển</option>
                                    <option value="Giao hàng thành công" {{ $order->order_status == 'Giao hàng thành công' ? 'selected' : '' }}>Giao Hàng Thành Công</option>
                                    <option value="Đã hủy" {{ $order->order_status == 'Đã hủy' ? 'selected' : '' }} {{ $order->order_status == 'Giao hàng thành công' ? 'disabled' : '' }}>Đã Hủy</option>
                                    <option value="Chờ thanh toán" {{ $order->order_status == 'Chờ thanh toán' ? 'selected' : '' }} {{ $order->order_status == 'Giao hàng thành công' ? 'disabled' : '' }}>Chờ Thanh Toán</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
