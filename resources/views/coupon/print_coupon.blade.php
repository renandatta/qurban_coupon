@extends('layouts.blank')

@section('content')
    <style>
        h1 {
            color: red;
            font-size: 1.5cm;
            font-family: Arial, serif;
            position: absolute;
            margin-left: 10cm;
            margin-top: 2.1cm;
        }
        .qrcode {
            position: absolute;
            margin-left: 5cm;
            margin-top: 2.55cm;
        }
        .qrcode-2 {
            position: absolute;
            margin-left: 5cm;
            margin-top: 3cm;
        }
    </style>
    <table style="width: 100%;">
        @php($pos = 1)
        @foreach($coupons as $key => $coupon)
            <tr>
                <td>
                    <h1 @if($pos == 6) style="margin-top: 2.6cm;" @endif>{{ $coupon->no_coupon }}</h1>
                    <svg @if($pos == 6) class="qrcode-2" @else class="qrcode" @endif id="barcode{{ $coupon->no_coupon }}" style="height: 2cm;width: 2cm;"></svg>
                    <img src="{{ asset('img/coupon.png') }}" alt="" style="width: 18.5cm;">
                </td>
            </tr>
            @if($pos == 6) 
                @php($pos = 1)
            @endif
            @php($pos++)
        @endforeach
    </table>
@endsection

@push('scripts')
    <script src="{{ asset('lib/qrcode/JsBarcode.all.min.js') }}"></script>
    <script>
        @foreach($coupons as $coupon)
            JsBarcode("#barcode{{ $coupon->no_coupon }}", '{{ $coupon->no_coupon }}', {
            format: "CODE39",
            // width: 4,
            height: 35,
            margin: 0,
            displayValue: false
        });
        @endforeach
    </script>
@endpush
