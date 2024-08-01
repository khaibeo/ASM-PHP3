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
                            <li class="breadcrumb-order"><a href="javascript: void(0);">Đơn hàng</a></li>
                            <li class="breadcrumb-order active">Danh sách đơn hàng</li>
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
                        <form>
                            <div class="row g-3">
                                <div class="col-xxl-5 col-sm-6">
                                    <div class="search-box">
                                        <input type="text" class="form-control search"
                                            placeholder="Tìm kiếm ID đơn hàng, khách hàng, trạng thái đơn hàng hoặc thông tin gì đó...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-sm-6">
                                    <div>
                                        <input type="text" class="form-control" data-provider="flatpickr"
                                            data-date-format="d M, Y" data-range-date="true" id="demo-datepicker"
                                            placeholder="Chọn Ngày">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-sm-4">
                                    <div>
                                        <select class="form-control" data-choices data-choices-search-false
                                            name="choices-single-default" id="idStatus">
                                            <option value="">Status</option>
                                            <option value="all" selected>All</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Inprogress">Inprogress</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Pickups">Pickups</option>
                                            <option value="Returns">Returns</option>
                                            <option value="Delivered">Delivered</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-sm-4">
                                    <div>
                                        <select class="form-control" data-choices data-choices-search-false
                                            name="choices-single-default" id="idPayment">
                                            <option value="">Select Payment</option>
                                            <option value="all" selected>All</option>
                                            <option value="Mastercard">Mastercard</option>
                                            <option value="Paypal">Paypal</option>
                                            <option value="Visa">Visa</option>
                                            <option value="COD">COD</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-1 col-sm-4">
                                    <div>
                                        <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i
                                                class="ri-equalizer-fill me-1 align-bottom"></i>
                                            Filters
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
                                                <th data-ordering="false">TÊN NGƯỜI DÙNG</th>
                                                <th>SỐ ĐIỆN THOẠI</th>
                                                <th>TRẠNG THÁI</th>
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
                                                    <td>{{ currencyFormat($order->total_amount) }}</td>
                                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                                    <td>
                                                        <ul class="list-unstyled d-flex gap-2">
                                                            <li><a href="{{ route('admin.orders.detail', $order->id) }}"
                                                                    class="btn btn-info">
                                                                    Chi tiết</a></li>
                                                            <li>
                                                                <a class="btn btn-danger"
                                                                    href="{{ route('admin.orders.delete', $order->id) }}"
                                                                    class="dropdown-order remove-order-btn">
                                                                    Xóa
                                                                </a>
                                                            </li>
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
@endsection
