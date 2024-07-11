@extends('admin.layout')

@section('title')
    Thêm người dùng
@endsection

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm người dùng</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Người dùng</a></li>
                        <li class="breadcrumb-item active">Thêm người dùng</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="project-title-input">Tên người dùng</label>
                        <input type="text" class="form-control" id="project-title-input">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="project-title-input">Số điện thoại</label>
                        <input type="text" class="form-control" id="project-title-input">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="project-title-input">Địa chỉ</label>
                        <input type="text" class="form-control" id="project-title-input">
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="mb-3 mb-lg-0">
                                <label for="choices-status-input" class="form-label">Vai trò</label>
                                <select class="form-select" data-choices data-choices-search-false id="choices-status-input">
                                    <option value="0" >Admin</option>
                                    <option value="1" selected>Nhân viên</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="project-thumbnail-img">Ảnh đại diện</label>
                        <input class="form-control" id="project-thumbnail-img" type="file" accept="image/png, image/gif, image/jpeg">
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="text-end mb-4">
                <button type="submit" class="btn btn-danger w-sm">Quay lại</button>
                <button type="submit" class="btn btn-success w-sm">Tạo</button>
            </div>
        </div>
        <!-- end col -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin đăng nhập</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="choices-categories-input" class="form-label">Email</label>
                        <input class="form-control" id="choices-text-input" type="text" />
                    </div>

                    <div class="mb-3">
                        <label for="choices-categories-input" class="form-label">Mật khẩu</label>
                        <input class="form-control" id="choices-text-input" type="text" />
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

</div>
<!-- container-fluid -->
@endsection

@section('scripts')
    <!-- project-create init -->
    <script src="{{ asset('administrator/assets/js/pages/project-create.init.js') }}"></script>
@endsection
