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
                   <div class="card-body border-bottom-dashed border-bottom">
                        {{-- <form> --}}
                            <div class="row g-3">
                                <div class="col-xl-6">
                                    <form action="{{ route('admin.users.search') }}" method="get">
                                    @csrf
                                    <div class="search-box">
                                        <input type="text" name="search" value="{{ request()->query('search', old('search')) }}"
                                            class="form-control search" placeholder="Nhập vai trò...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </form>
                                </div>
                                <!--end col-->
                               {{--   <div class="col-xl-6">
                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <div class="">
                                                <input type="text" class="form-control" id="datepicker-range"
                                                    data-provider="flatpickr" data-date-format="d M, Y"
                                                    data-range-date="true" placeholder="Select date">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-sm-4">
                                            <div>
                                                <select class="form-control" data-plugin="choices" data-choices
                                                    data-choices-search-false name="choices-single-default" id="idStatus">
                                                    <option value="">Status</option>
                                                    <option value="all" selected>All</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Block">Block</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->

                                        <div class="col-sm-4">
                                            <div>
                                                <button type="button" class="btn btn-primary w-100"
                                                    onclick="SearchData();"> <i
                                                        class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </form>
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example"
                                        class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 10px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll"
                                                            value="option">
                                                    </div>
                                                </th>
                                                <th data-ordering="false">ID</th>
                                                <th data-ordering="false">Ảnh</th>
                                                <th data-ordering="false">Tên</th>
                                                <th data-ordering="false">Vai trò</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $key => $user)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input fs-15" type="checkbox"
                                                                name="checkAll" value="option1">

                                                        </div>
                                                    </th>
                                                    <td>{{ $user->id }}</td>
                                                    <td>
                                                        <img src="{{ Storage::url($user->thumbnail) }}" alt=""
                                                            width="150px;">
                                                    </td>
                                                    <td>{{ $user->name }}</td>
                                                    {{-- <td>{{ $user->email }}</td> --}}

                                                    <td>
                                                        @if ($user->role == 'admin')
                                                            <span
                                                                class="badge bg-info-subtle text-info">Admin</span>
                                                        @elseif ($user->role == 'customer')
                                                            <span
                                                                class="badge bg-info-subtle text-primary">Customer</span>
                                                        @else
                                                            <span
                                                                class="badge bg-warning-subtle text-success">Staff</span>
                                                        @endif

                                                    </td>


                                                    <td>
                                                     
                                                          
                                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                                            class="dropdown-item edit-item-btn btn btn-primary"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"> Edit</i>
                                                           </a>

                                                             

                                                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                            method="POST" class="dropdown-item remove-item-btn ">
                                                            @method('DELETE')
                                                            @csrf

                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted">
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Bạn có chắc muốn xóa người dùng này không?')">
                                                                    Delete</button>
                                                            </i>

                                                        </form>

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
@endsection
