<div class="table-responsive">
    <table class="table table-sm table-bordered">
        <thead>
        <tr>
            <th class="text-center" width="50px">No</th>
            <th>Nomor Kupon</th>
            <th>Nama</th>
            <th>Status</th>
            <th width="210px"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($coupons as $key => $coupon)
            <tr>
                <td>
                    @if($coupons instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        {{ (($coupons->currentPage()-1)*10)+($key+1) }}
                    @else {{ $key+1 }} @endif
                </td>
                <td>{{ $coupon->no_coupon }}</td>
                <td>{{ $coupon->name }}</td>
                <td>{{ $coupon->is_claim == 1 ? 'Sudah Diambil' : 'Belum Diambil' }}</td>
                @if($coupon->is_claim == 0)
                    <td class="p-0">
                        <button type="button" onclick="claimCoupon({{ $coupon->id }})" class="btn btn-primary btn-block btn-sm border-radius-0 btn-claim">Proses Ambil</button>
                    </td>
                @endif
                @if($coupon->is_claim == 1)
                    <td>
                        {{ $coupon->claim_at. ', ' .$coupon->claim_media }}
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $coupons->links() }}
