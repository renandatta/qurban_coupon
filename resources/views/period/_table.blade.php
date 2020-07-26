<div class="table-responsive">
    <table class="table table-sm table-bordered">
        <thead>
        <tr>
            <th class="text-center" width="50px">No</th>
            <th>Nama</th>
            <th>Tahun</th>
            <th class="text-center" width="100px"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($periods as $key => $period)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $period->name }}</td>
                <td>{{ $period->year }}</td>
                <td>
                    <a href="{{ route('period.info', 'id=' . $period->id) }}">Ubah</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $periods->links() }}
