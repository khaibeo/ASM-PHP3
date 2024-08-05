@extends('admin.layout')

@section('title')
    Danh sách người dùng
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Danh sách người dùng</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Người dùng</a></li>
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
                                    <h5 class="card-title mb-0">Danh sách người dùng</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="d-flex flex-wrap align-items-start gap-2">
                                    <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i
                                            class="ri-delete-bin-2-line"></i></button>
                                    <a href="{{ route('admin.users.add') }}" class="btn btn-success add-btn"><i
                                            class="ri-add-line align-bottom me-1"></i> Thêm </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body border-bottom-dashed border-bottom mb-3">
                        <form action="{{ route('admin.users.index') }}" method="get">
                            <div class="row g-3">
                                <div class="col-xl-3">
                                    <div>
                                        <select class="form-control" name="role" id="role">
                                            <option value="all" selected>Lọc theo vai trò</option>
                                            <option value="admin">Quản trị viên</option>
                                            <option value="staff">Nhân viên</option>
                                            <option value="customer">Khách hàng</option>
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
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body mt-2">
                                    <table id="example"
                                        class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                {{-- <th scope="col" style="width: 10px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll"
                                                            value="option">
                                                    </div>
                                                </th> --}}
                                                <th data-ordering="false">ID</th>
                                                <th data-ordering="false">Ảnh</th>
                                                <th data-ordering="false">Tên</th>
                                                <th data-ordering="false">Email</th>
                                                <th data-ordering="false">Vai trò</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $key => $user)
                                                <tr>
                                                    {{-- <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input fs-15" type="checkbox"
                                                                name="checkAll" value="option1">

                                                        </div>
                                                    </th> --}}
                                                    <td>{{ $user->id }}</td>
                                                    <td>
                                                        <img src="{{ Storage::url($user->thumbnail) }}" alt=""
                                                            height="100" width="100;">
                                                    </td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>

                                                    <td>
                                                        @if ($user->role == 'admin')
                                                            <span class="badge bg-info-subtle text-info">Quản trị
                                                                viên</span>
                                                        @elseif ($user->role == 'customer')
                                                            <span class="badge bg-info-subtle text-primary">Khách
                                                                hàng</span>
                                                        @else
                                                            <span class="badge bg-warning-subtle text-success">Nhân
                                                                viên</span>
                                                        @endif

                                                    </td>


                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                                class="btn btn-primary">Sửa
                                                            </a>
    
                                                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger"
                                                                    onclick="return confirm('Bạn có chắc muốn xóa người dùng này không?')">
                                                                    Xóa</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
        new DataTable("#example", {
            "ordering": false
        });
    </script>
@endsection
