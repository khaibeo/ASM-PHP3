@extends('admin.layout')

@section('title')
    Quản lý Slider
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Quản lý Slider</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý Slider</a></li>
                            <li class="breadcrumb-item active">Danh sách</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                @session('success')
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endsession

                @session('error')
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endsession
                <div class="card" id="sliderList">
                    <div class="card-header border-bottom-dashed">
                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Danh sách Slider</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="d-flex flex-wrap align-items-start gap-2">
                                    <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i
                                            class="ri-delete-bin-2-line"></i></button>
                                    <a href="{{route('admin.banners.create')}}" type="button" class="btn btn-success add-btn"
                                        id="create-btn"><i
                                            class="ri-add-line align-bottom me-1"></i> Thêm </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 10px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th>ID</th>
                                                <th>Tiêu đề</th>
                                                <th>Số lượng ảnh</th>
                                                <th>Trạng thái</th>
                                                <th>Thời gian tạo</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sliders as $slider)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                    </div>
                                                </th>
                                                <td>{{ $slider->id }}</td>
                                                <td>{{ $slider->title }}</td>
                                                <td>{{ $slider->details->count() }}</td>
                                                <td>
                                                    <span class="badge {{ $slider->active ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $slider->active ? 'Kích hoạt' : 'Vô hiệu' }}
                                                    </span>
                                                </td>
                                                <td>{{ $slider->created_at->format('d/m/Y H:i:s') }}</td>
                                                <td>
                                                    <div class="dropdown d-inline-block">
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a href="{{ route('admin.banners.edit', $slider->id) }}" class="dropdown-item">
                                                                    <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Sửa
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form id="toggle-form-{{ $slider->id }}" action="{{ route('admin.banners.updateStatus', $slider->id) }}" method="POST" style="display: inline;">
                                                                    @csrf
                                                                    <button type="button" class="dropdown-item" onclick="confirmToggle({{ $slider->id }}, '{{ $slider->active ? 'Vô hiệu hóa' : 'Kích hoạt' }}')">
                                                                        <i class="ri-toggle-line align-bottom me-2 text-muted"></i> {{ $slider->active ? 'Vô hiệu hóa' : 'Kích hoạt' }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item remove-item-btn">
                                                                    <form action="{{ route('admin.banners.destroy', $slider->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Bạn có chắc chắn muốn xóa slider này?')">
                                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Xóa
                                                                        </button>
                                                                    </form>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
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
    <script>
    function confirmToggle(sliderId, action) {
        if (confirm(`Bạn có chắc chắn muốn ${action} slide này?`)) {
            document.getElementById(`toggle-form-${sliderId}`).submit();
        }
    }
    </script>
@endsection