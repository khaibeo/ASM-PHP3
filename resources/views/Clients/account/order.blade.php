@extends('Clients.layout')
@section('title')
Đơn hàng
@endsection
@section('content')
<main>
    <!-- layout-wrapper -->
    <div class="container margin_30">
        <div class="layout-wrapper">
            <!-- content -->
            <div class="content">

                <div class="row flex-column-reverse flex-md-row">
                    @include('Clients.account.sidebar')
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-header mb-3">Đơn hàng của tôi</h5>
                                
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