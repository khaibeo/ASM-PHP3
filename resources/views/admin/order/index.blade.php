@extends('admin.layout')

@section('title')
    Danh sách đơn hàng
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-orders-center justify-content-between">
                    <h4 class="mb-sm-0">Đơn Hàng</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Đơn hàng</a></li>
                            <li class="breadcrumb-item active">Danh sách đơn hàng</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="orderList">
                    <div class="card-header border-0">
                        <div class="row align-orders-center gy-3">
                            <div class="col-sm">
                                <h5 class="card-title mb-0">Lịch Sử Đơn Hàng</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border border-dashed border-end-0 border-start-0">
                        <form method="GET" action="{{route('admin.orders.index')}}">
                            <div class="row g-3">
                                <div class="col-xxl-3 col-sm-6">
                                    <div>
                                        <input type="text" class="form-control" name="date" data-provider="flatpickr"
                                            data-date-format="d-m-Y" data-range-date="true" id="demo-datepicker"
                                            placeholder="Chọn Ngày">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-sm-4">
                                    <div>
                                        <select class="form-control" name="status" id="order_status">
                                            <option value="all" selected>Trạng thái</option>
                                            <option value="pending">Chờ duyệt</option>
                                            <option value="processing">Đang chuẩn bị</option>
                                            <option value="shipped">Đang giao hàng</option>
                                            <option value="delivered">Đã giao</option>
                                            <option value="cancelled">Đã hủy</option>
                                            <option value="unpaid">Chưa thanh toán</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-4 col-sm-4">
                                    <div>
                                        <select class="form-control" name="payment" id="payment">
                                            <option value="all" selected>Phương thức thanh toán</option>
                                            <option value="0">COD</option>
                                            <option value="1">VNPay</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-sm-4">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-100"> <i
                                                class="ri-equalizer-fill me-1 align-bottom"></i>
                                            Lọc
                                        </button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example"
                                        class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th data-ordering="false">ID</th>
                                                <th data-ordering="false">TÊN NGƯỜI MUA</th>
                                                <th>SỐ ĐIỆN THOẠI</th>
                                                <th>TRẠNG THÁI</th>
                                                <th>THANH TOÁN</th>
                                                <th>THÀNH TIỀN</th>
                                                <th>NGÀY ĐẶT</th>
                                                <th>HÀNH ĐỘNG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>#{{ $order->id }}</td>
                                                    <td>{{ $order->name }}</td>
                                                    <td>{{ $order->phone }}</td>
                                                    <td>{{ getOrderStatus($order->order_status) }}</td>
                                                    <td>{{ $order->payment_method == 0 ? 'COD' : 'VNPay' }}</td>
                                                    <td>{{ currencyFormat($order->total_amount) }}</td>
                                                    <td>{{ $order->created_at->format('d-m-Y H:i:s') }}</td>
                                                    <td>
                                                        <ul class="list-unstyled d-flex gap-2">
                                                            <li><a href="{{ route('admin.orders.detail', $order->id) }}"
                                                                    class="btn btn-info">
                                                                    Chi tiết</a></li>
                                                            @can('admin')
                                                            <li>
                                                                <a class="btn btn-danger"
                                                                    href="{{ route('admin.orders.delete', $order->id) }}"
                                                                    class="dropdown-order remove-order-btn">
                                                                    Xóa
                                                                </a>
                                                            </li>
                                                            @endcan
                                                            {{-- <li>
                                                            <a href="{{ route('admin.orders.editStatus', $order->id) }}" class="dropdown-order remove-order-btn">
                                                                <i
                                                                    class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                    Cập nhật trạng thái
                                                            </a>
                                                        </li> --}}
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>

            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div>
    <!-- container-fluid -->
@endsection

@section('stylesheets')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- Sweet Alert css-->
    <link href="{{ asset('administrator/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ asset('administrator/assets/js/pages/datatables.init.js') }}"></script>

    <!-- ecommerce-order init js -->
    <script src="{{ asset('administrator/assets/js/pages/ecommerce-order.init.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('administrator/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        new DataTable("#example", {
            "ordering": false
        });
    </script>
@endsection
