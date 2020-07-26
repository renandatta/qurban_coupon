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
                <div class="row">
                    <div class="col-md-6 text-left">
                        <button type="button" onclick="toggleSearch()" class="btn btn-info">Pencarian</button>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('period.info') }}" class="btn btn-primary">Tambahkan</a>
                    </div>
                </div>
                <form action="" method="post" style="display: none;" id="form_search">
                    @csrf
                    <div class="input-group mt-3">
                        <input type="text" class="form-control" id="search_name" name="name" placeholder="Pencarian">
                        <div class="input-group-append">
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
        function toggleSearch() {
            $('#form_search').slideToggle();
        }
        function searchData(page = 1) {
            if (page.toString() === '-1') page = selectedPage-1;
            if (page.toString() === '+1') page = selectedPage+1;
            selectedPage = page;
            $('#form_search').trigger('submit');
        }
        $('#form_search').submit(function (e) {
            e.preventDefault();
            $.post("{{ route('period.search') }}?page=" + selectedPage, {
                _token: '{{ csrf_token() }}',
                name: $('#search_name').val()
            }, function (result) {
                $('#content_table').html(result);
            }).fail(function (xhr) {
                console.log(xhr.responseText);
            });
        });
        searchData();
    </script>
@endpush
