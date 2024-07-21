@extends('admin.layout')

@section('title')
    Chi tiết thông tin người dùng
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="col-xxl-3">
                    <div class="card mt-3">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    <img src="{{ Storage::url($user->thumbnail) }}"
                                        class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                        alt="user-profile-image">
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                        <input id="profile-img-file-input" type="file" name="thumbnail" class="profile-img-file-input">
                                        <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                <i class="ri-camera-fill"></i>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <h5 class="fs-16 mb-1">{{ $user->name }}</h5>
                                <p class="text-muted mb-0"></p>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                <div class="col-xxl-9">
                    <div class="card mt-xxl-3">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                        <i class="fas fa-home"></i> Thông tin người dùng
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                        <i class="far fa-user"></i> Đổi mật khẩu
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">Tên người dùng</label>
                                                <input type="text" class="form-control" name="name"
                                                    id="firstnameInput" placeholder="Enter your firstname"
                                                    value="{{ $user->name }}">
                                                @error('name')
                                                    <b class="text-danger">{{ $errors->first('name') }}</b>
                                                @enderror
                                            </div>

                                        </div>
                                        <!--end col-->

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Số điện thoại</label>
                                                <input type="text" class="form-control" name="phone"
                                                    id="phonenumberInput" placeholder="Enter your phone number"
                                                    value="{{ $user->phone }}">
                                                @error('phone')
                                                    <b class="text-danger">{{ $errors->first('phone') }}</b>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" id="emailInput"
                                                    placeholder="Enter your email" value="{{ $user->email }}">
                                                @error('email')
                                                    <b class="text-danger">{{ $errors->first('email') }}</b>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="JoiningdatInput" class="form-label">Địa chỉ</label>
                                                <input type="text" class="form-control" name="address"
                                                    id="JoiningdatInput" value="{{ $user->address }}"
                                                    placeholder="Select date" />
                                                @error('address')
                                                    <b class="text-danger">{{ $errors->first('address') }}</b>
                                                @enderror
                                            </div>

                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="choices-status-input" class="form-label">Vai trò</label>
                                                <select class="form-select" name="role" data-choices
                                                    data-choices-search-false id="choices-status-input">
                                                    <option value="customer" selected>Khách hàng</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="staff" >Nhân viên</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <a href="{{ route('admin.user.index') }}"  class="btn btn-success">Sửa</a>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                    >
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane" id="changePassword" role="tabpanel">
                                    <div class="row g-2">
                                        <div class="col-lg-4">

                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="newpasswordInput" class="form-label">Mật khẩu
                                                        *</label>
                                                    <input name="password" class="form-control" id="newpasswordInput"
                                                        value="{{ $user->password }}">
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <a href="javascript:void(0);"
                                                        class="link-primary text-decoration-underline">Quên mật
                                                        khẩu</a>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-success">Đổi mật
                                                        khẩu</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end tab-pane-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
            </form>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    @endsection
