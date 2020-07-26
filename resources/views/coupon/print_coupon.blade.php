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
    </style>
    <table style="width: 100%;">
        @foreach($coupons as $coupon)
            <tr>
                <td>
                    <h1>{{ $coupon->no_coupon }}</h1>
                    <svg class="qrcode" id="barcode{{ $coupon->no_coupon }}" style="height: 2cm;width: 2cm;"></svg>
                    <img src="{{ asset('img/coupon.png') }}" alt="" style="width: 18.5cm;">
                </td>
            </tr>
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
