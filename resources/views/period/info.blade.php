@extends('layouts.main')

@section('title')
    {{ !empty($period) ? 'Ubah' : 'Tambah' }} {{ $title }}
@endsection

@section('content')
    <div class="container pt-4">
        <h3>
            <img src="{{ asset('img/logo.png') }}" alt="" class="img-fluid" style="height: 28px">
            {{ !empty($period) ? 'Ubah' : 'Tambah' }} {{ $title }}
        </h3>
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('period.save') }}" method="post">
                    @csrf
                    @if(!empty($period))
                        <input type="hidden" name="id" value="{{ $period->id }}">
                    @endif
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ !empty($period) ? $period->name : old('period') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Tahun</label>
                        <input type="text" class="form-control" id="year" name="year" value="{{ !empty($period) ? $period->year : old('year') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('period') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
            <div class="card-footer text-right p-2">
                @if(!empty($period))
                    <form action="{{ route('period.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $period->id }}">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
