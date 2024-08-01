@extends('Clients.layout')
@section('title')
Đổi mật khẩu
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
                                <form action="{{route('user.updaterepass')}}" method="post">
                                    @csrf
                                <div class="mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title mb-4">Đổi mật khẩu</h6>
                                            @if (session('success'))
                                                <div class="alert alert-success">{{session('success')}}</div>
                                            @endif
                                            <div class="mb-3">
                                                <label class="form-label">Mật khẩu cũ</label>
                                                <input type="password" class="form-control" name="old_pass" value="{{old('old_pass')}}">
                                                @error('old_pass')
                                                    <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Mật khẩu mới</label>
                                                <input type="password" class="form-control" name="new_pass" value="{{old('new_pass')}}">
                                                @error('new_pass')
                                                    <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nhập lại mật khẩu mới</label>
                                                <input type="password" class="form-control" name="new_pass_confirmation" value="{{old('new_pass_confirmation')}}">
                                                @error('new_pass_confirmation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <button class="btn btn-primary me-2" type="submit">Thay đổi</button>
             
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