@extends('admin.layout')

@section('title')
    Danh sách mã giảm giá
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Danh sách mã giảm giá</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mã giảm giá</a></li>
                            <li class="breadcrumb-item active">Danh sách</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="customerList">
                    <div class="card-header border-bottom-dashed">
                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Mã giảm giá</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="d-flex flex-wrap align-items-start gap-2">
                                    <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()">
                                        <i class="ri-delete-bin-2-line"></i></button>
                                    <a class="btn btn-success add-btn" href="{{ route('admin.vouchers.add') }}"
                                        id="create-btn">
                                        <i class="ri-add-line align-bottom me-1"></i> Thêm </a>
                                    <a href="{{route('admin.vouchers.import')}}" class="btn btn-info"><i
                                            class="ri-file-download-line align-bottom me-1"></i> Import</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="GET" action="{{ route('admin.vouchers.index') }}" class="mb-3">
                                        <div class="row g-3">
                                            <div class="col-xxl-2 col-sm-6">
                                                <div>
                                                    <select name="discount_type" class="form-select">
                                                        <option value="">Loại giảm giá</option>
                                                        <option value="0">Số Lượng</option>
                                                        <option value="1">Phần Trăm</option>
                                                    </select>
                                                </div>
                                            </div>
            
                                            <div class="col-xxl-2 col-sm-4">
                                                <div>
                                                    <select name="expiry_status" class="form-select">
                                                        <option value="">Hạn sử dụng</option>
                                                        <option value="active">Còn hạn</option>
                                                        <option value="expired">Hết hạn</option>
                                                    </select>
                                                </div>
                                            </div>
            
                                            <div class="col-xxl-2 col-sm-4">
                                                <div>
                                                    <select name="display_status" class="form-select">
                                                        <option value="">Trạng thái</option>
                                                        <option value="1">Hiển Thị</option>
                                                        <option value="0">Ẩn</option>
                                                    </select>
                                                </div>
                                            </div>
            
                                            <div class="col-xxl-2 col-sm-4">
                                                <div>
                                                    <button type="submit" class="btn btn-primary w-100"> <i
                                                            class="ri-equalizer-fill me-1 align-bottom"></i>
                                                        Lọc
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <table id="example mt-3"
                                        class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th data-ordering="false">ID</th>
                                                <th data-ordering="false">Tên Mã</th>
                                                <th data-ordering="false">Code</th>
                                                <th data-ordering="false">Loại Giảm Giá</th>
                                                <th>Giá Giảm</th>
                                                <th>Số Lượng</th>
                                                <th>Có Hiệu Lực Từ </th>
                                                <th>Ngày Hết Hạn</th>
                                                <th>Hiển Thị</th>
                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($vouchers as $voucher)
                                                <tr>
                                                    <td>{{ $voucher->id }}</td>
                                                    <td>{{ $voucher->name }}</td>
                                                    <td>{{ $voucher->code }}</td>
                                                    <td>
                                                        @if ($voucher->discount_type == 0)
                                                            Trực tiếp
                                                        @else
                                                            Phần Trăm
                                                        @endif
                                                    </td>
                                                    <td>{{ $voucher->discount_value }}</td>
                                                    <td>{{ $voucher->quantity }}</td>
                                                    <td><span
                                                            class="badge bg-warning">{{ \Carbon\Carbon::parse( $voucher->valid_from)->format('d/m/Y H:i:s') }}</span>
                                                    </td>
                                                    <td><span class="badge bg-danger">{{ \Carbon\Carbon::parse( $voucher->valid_until)->format('d/m/Y H:i:s') }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($voucher->display_status == 1)
                                                            <span class="badge bg-success">Hiển Thị</span>
                                                        @else
                                                            <span class="badge bg-secondary">Ẩn</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="dropdown d-inline-block">
                                                            <button class="btn btn-soft-secondary btn-sm dropdown"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="ri-more-fill align-middle"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a href="{{ route('admin.vouchers.edit', $voucher->id) }}"
                                                                        class="dropdown-item edit-item-btn">
                                                                        <i
                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                        Sửa</a></li>
                                                                <li>
                                                                    <a href="{{ route('admin.vouchers.delete', $voucher->id) }}"
                                                                        class="dropdown-item remove-item-btn">
                                                                        <i
                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                        Xóa</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{$vouchers->links()}}
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
@endsection
