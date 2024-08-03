@extends('Clients.layout')
@section('title')
    Voucher
@endsection
@section('stylesheets')
    <link href="{{ asset('client/css/voucher.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main class="bg_gray">
        <div class="container">
            <div class="page">
                <img src="https://down-vn.img.susercontent.com/file/vn-11134258-7r98o-lxhqyunswpnfbd@resize_w1920_nl.webp"
                    width="100%" alt="">
                <h1>Danh Sách VouCher</h1>
            </div>
            <div class="row">
                @foreach ($vouchers as $voucher)
                    <div class="col-md-4">
                        <div class="voucher-item">
                            <div class="voucher-details">
                                <h3>{{ $voucher->name }} - {{$voucher->code}}</h3>
                                @if ($voucher->discount_type == 0)
                                    <p> Giảm {{ currencyFormat($voucher->discount_value) }}</p>
                                @else
                                    <p> Giảm {{ $voucher->discount_value }}%</p>
                                @endif

                                <p> {{ Str::limit($voucher->description, 50) }}</p>
                                
                                <p>Có hiệu lực từ {{ Carbon\Carbon::parse($voucher->valid_from)->format('d/m/Y') . ' - ' . Carbon\Carbon::parse($voucher->valid_until)->format('d/m/Y') }}</p>
                                
                            </div>
                            <div class="voucher-actions">
                                <button type="button" id="save-voucher" data-code="{{ $voucher->code }}"
                                    class="save-button">Lưu</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        var listBtn = document.querySelectorAll(".save-button");

        for (const btn of listBtn) {
            btn.addEventListener('click', (e) => {
                var code = e.target.getAttribute('data-code');

                navigator.clipboard.writeText(code)
                .then(() => {
                    alert("Sao chép thành công: " + code);
                })
                .catch(err => {
                    console.error('Không thể sao chép: ', err);
                });
            });   
        }
    </script>
@endsection
