<div class="col-md-3">
                        <div class="d-flex flex-column flex-md-row text-center text-md-start mb-3">
                            <figure class="me-4 flex-shrink-0">
                               
                                <img width="100" height="100" class="rounded-pill" src="{{ $user->thumbnail ? asset('storage/' . $user->thumbnail) : asset('default-thumbnail.png') }}" alt="...">
                            </figure>
                            <div class="flex-fill">
                                <h5 class="mb-3">{{$user->name}}</h5>
                                <a class="btn btn-primary me-2" href="{{route('user.profile')}}">Sửa thông tin</a>
                            </div>
                        </div>
                        <div class="card sticky-top mb-4 mb-md-0">
                            <div class="card-body bg-primary text-white">
                                <ul class="nav nav-pills flex-column gap-2" id="myTab" role="tablist">
                                    <li class="nav-item mb-1">
                                        <a class="nav-link text-white" id="profile-tab" href="{{route('user.profile')}}" aria-controls="profile" aria-selected="true">
                                            <i class="bi bi-person me-2"></i> Thông tin tài khoản
                                        </a>
                                    </li>
                                    <li class="nav-item mb-1 " role="presentation">
                                        <a class="nav-link text-white" id="password-tab" href="{{route('user.repass')}}" aria-controls="password" aria-selected="false">
                                            <i class="bi bi-lock me-2"></i> Đổi mật khẩu
                                        </a>
                                    </li>
                                    <li class="nav-item mb-1 " role="presentation">
                                        <a class="nav-link text-white" id="password-tab" href="{{route('user.order')}}" aria-controls="password" aria-selected="false">
                                            <i class="bi bi-lock me-2"></i> Đơn hàng
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>