@extends('layouts.main')

@section('title')
    Informasi Periode
@endsection

@section('content')
    <div class="container pt-4">
        <h3>
            <img src="{{ asset('img/logo.png') }}" alt="" class="img-fluid" style="height: 28px">
            Informasi Periode
        </h3>
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="" method="post">
                    @csrf

                        <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Tahun</label>
                        <input type="text" class="form-control" id="year" name="year" value="" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('period') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
            <div class="card-footer text-right p-2">

                    <form action="" method="post">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>

            </div>
        </div>
    </div>
@endsection
