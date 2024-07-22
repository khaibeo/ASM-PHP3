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
        <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label" for="project-title-input in">Tên người dùng</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    id="project-title-input">
                                @error('name')
                                    <b class="text-danger">{{ $errors->first('name') }}</b>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="project-title-input">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}"
                                    id="project-title-input">
                                @error('phone')
                                    <b class="text-danger">{{ $errors->first('phone') }}</b>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="project-title-input">Địa chỉ</label>
                                <input type="text" class="form-control" value="{{ old('address') }}" name="address"
                                    id="project-title-input">
                                @error('address')
                                    <b class="text-danger">{{ $errors->first('address') }}</b>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="mb-3 mb-lg-0">
                                        <label for="choices-status-input" class="form-label">Vai trò</label>
                                        <select class="form-select" data-choices data-choices-search-false
                                            id="choices-status-input" name="role">
                                            <option value="customer" selected>Khách hàng</option>
                                            <option value="admin">Admin</option>
                                            <option value="staff">Nhân viên</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="project-thumbnail-img">Ảnh đại diện</label>
                                <input class="form-control" id="project-thumbnail-img" name="thumbnail" type="file"
                                    value="{{ old('thumbnail') }}" accept="image/png, image/gif, image/jpeg">
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="text-end mb-4">
                        <button type="submit" class="btn btn-success w-sm">Tạo</button>
                        <a href="{{route('admin.users.index')}}" type="submit" class="btn btn-danger w-sm">Quay lại</a>
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
                                <input class="form-control" id="choices-text-input" name="email"
                                    value="{{ old('email') }}" type="text" />
                                @error('email')
                                    <b class="text-danger">{{ $errors->first('email') }}</b>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="choices-categories-input" class="form-label">Mật khẩu</label>
                                <input class="form-control" name="password" id="choices-text-input" type="text" />
                                @error('password')
                                    <b class="text-danger">{{ $errors->first('password') }}</b>
                                @enderror
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </form>
    </div>
    <!-- container-fluid -->
@endsection

@section('scripts')
    <!-- project-create init -->
    <script src="{{ asset('administrator/assets/js/pages/project-create.init.js') }}"></script>
@endsection
