@extends('Clients.layout')
@section('title')
Voucher
@endsection
@section('stylesheets')
<link href="{{ asset('client/css/voucher.css')}}" rel="stylesheet">
@endsection
@section('content')
<main class="bg_gray">
    <div class="container">
        <div class="page">
           <img src="https://down-vn.img.susercontent.com/file/vn-11134258-7r98o-lxhqyunswpnfbd@resize_w1920_nl.webp" width="100%" alt="">
           <h1>Danh Sách VouCher</h1>
        </div>
        <div class="row">
            @foreach ($vouchers as $voucher)
                <div class="col-md-4">
                    <div class="voucher-item">
                        <div class="voucher-details">
                            <h3>{{ $voucher->name }}</h3>
                            <p> {{ Str::limit($voucher->description, 50) }}</p>
                            <p>Có hiệu lực từ ngày {{ $voucher->valid_from }}</p>
                        </div>
                        <div class="voucher-actions">
                            <form method="POST" action="{{ route('save.voucher', $voucher->id) }}">
                                @csrf
                                <button type="submit" class="save-button">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>

@if(session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
@endif

@if(session('error'))
    <script>
        alert('{{ session('error') }}');
    </script>
@endif

@endsection
