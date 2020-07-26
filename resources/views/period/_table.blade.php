<div class="table-responsive">
    <table class="table table-sm table-bordered">
        <thead>
        <tr>
            <th class="text-center" width="50px">No</th>
            <th>Nama</th>
            <th>Tahun</th>
            <th class="text-center" width="50px"></th>
            <th class="text-center" width="70px"></th>
            <th class="text-center" width="130px"></th>
        </tr
        </thead>
        <tbody>
        @foreach($periods as $key => $period)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $period->name }}</td>
                <td>{{ $period->year }}</td>
                <td class="text-center">
                    <a href="{{ route('period.info', 'id=' . $period->id) }}">Ubah</a>
                </td>
                <td class="text-center">
                    <a target="_blank" href="{{ route('period.print_coupon', 'id=' . $period->id) }}">Cetak</a>
                </td>
                <td>
                    @if($period->is_generate == 0)
                        <a href="javascript:void(0)" onclick="generateCoupon({{ $period->id }})">Generate Kupon</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $periods->links() }}
