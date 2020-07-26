@extends('layouts.main')

@section('title')
    {{ $title }} -
@endsection

@section('content')
    <div class="container pt-4">
        <h3>
            <img src="{{ asset('img/logo.png') }}" alt="" class="img-fluid" style="height: 28px">
            {{ $title }}
        </h3>
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="" method="post" id="form_search">
                    @csrf
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <select name="period_id" id="search_period_id" class="form-control">
                                <option value="">Semua Periode Qurban</option>
                                @foreach($periods as $period)
                                    <option value="{{ $period->id }}">{{ $period->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="text" class="form-control" id="search_name" name="name" placeholder="Pencarian" autofocus>
                        <div class="input-group-append">
                            <select name="is_claim" id="search_is_claim" class="form-control" style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                <option value="">Semua Status</option>
                                <option value="1">Sudah Diambil</option>
                                <option value="0">Belum Diambil</option>
                            </select>
                            <button type="submit" class="btn btn-secondary" id="button_search">Cari</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div id="content_table">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let selectedPage = 1;
        function searchData(page = 1) {
            if (page.toString() === '-1') page = selectedPage-1;
            if (page.toString() === '+1') page = selectedPage+1;
            selectedPage = page;
            $('#form_search').trigger('submit');
        }
        function claimCoupon(id)
        {
            $.post("{{ route('coupon.claim') }}", {
                _token: '{{ csrf_token() }}',
                id: id
            }, function () {
                $('#form_search').trigger('submit');
            }).fail(function (xhr) {
                console.log(xhr.responseText);
            });
        }
        $('#form_search').submit(function (e) {
            e.preventDefault();
            $.post("{{ route('coupon.search') }}?page=" + selectedPage, {
                _token: '{{ csrf_token() }}',
                name: $('#search_name').val(),
                period_id: $('#search_period_id').find('option:selected').val(),
                is_claim: $('#search_is_claim').find('option:selected').val(),
            }, function (result) {
                $('#content_table').html(result);
            }).fail(function (xhr) {
                console.log(xhr.responseText);
            });
        });
        $('#search_name').keydown(function (e) {
            if (e.which === 13 && e.altKey) {
                let button = $('.btn-claim:first').trigger('click');
            }
        });
        searchData();
    </script>
@endpush
