@extends('layouts.main')

@section('title')
    Halaman Utama -
@endsection

@section('content')
    <div class="container pt-4 pb-5">
        @foreach($periods as $period)
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-6 border-right">
                            <h5 class="mb-0">Periode : </h5>
                            <h3 class="mb-0">{{ $period->name }}</h3>
                        </div>
                        <div class="col-md-3 border-right text-right">
                            <h5 class="mb-0">Sudah Diambil : </h5>
                            <h3 class="mb-0">{{ $period->claimed }}</h3>
                        </div>
                        <div class="col-md-3 text-right">
                            <h5 class="mb-0">Belum Diambil : </h5>
                            <h3 class="mb-0">{{ $period->not_claimed }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

