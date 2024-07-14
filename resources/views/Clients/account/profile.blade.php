@extends('Clients.layout')
@section('title')
Hồ sơ cá nhân
@endsection
@section('content')
<main>
    <!-- layout-wrapper -->
    <div class="container margin_30">
        <div class="layout-wrapper">
            <!-- content -->
            <div class="content ">

                <div class="row flex-column-reverse flex-md-row">
                   @include('Clients.account.sidebar')
                    <div class="col-md-9">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-4">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <h6 class="card-title mb-4">Thông tin cá nhân</h6>

                                                <div class="row text-center mb-4">
                                                    <div class="col">
                                                        <figure class="me-4">
                                                            <img width="100" height="100" class="rounded-pill" src="" alt="...">
                                                        </figure>
                                                        <input type="file" name="img" placeholder="Chọn ảnh">
                                                       
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Tên đăng nhập</label>
                                                            <input type="text" class="form-control" value="rtertert" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Email</label>
                                                            <input type="email" name="email" class="form-control" value="reterrtertr" required>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Họ và tên</label>
                                                            <input type="text" name="fullname" class="form-control" value="tertertertertert">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Số điện thoại</label>
                                                            <input type="text" name="tel" class="form-control" value="0848230200">
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label">Địa chỉ</label>
                                                            <input type="text" name="address" class="form-control" value="134/44/9 Nguyen Xa">
                                                        </div>
                                                    </div>
                                                </div>

                                                <button class="btn btn-primary me-2">Lưu thay đổi</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ./ content -->
        </div>
    </div>
</main>
@endsection
