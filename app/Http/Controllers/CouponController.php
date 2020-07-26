<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    protected $coupon, $period;
    public function __construct(Coupon $coupon, Period $period)
    {
        $this->middleware('auth');
        $this->coupon = $coupon;
        $this->period = $period;
        view()->share('title', 'Kupon Pengambilan');
    }

    public function index()
    {
        Session::put('menu_active', 'coupon');
        $periods = $this->period->orderBy('id', 'desc')->get();
        return view('coupon.index', compact('periods'));
    }

    public function search(Request $request)
    {
        $coupons = $this->coupon;
        if ($request->has('name') && $request->input('name') != '')
            $coupons = $coupons->where('name', 'like', '%'. $request->input('name') .'%');
        if ($request->has('period_id') && $request->input('period_id') != '')
            $coupons = $coupons->where('period_id', '=', $request->input('period_id'));
        if ($request->has('is_claim') && $request->input('is_claim') != '')
            $coupons = $coupons->where('is_claim', '=', $request->input('is_claim'));
        if ($request->has('ajax')) return $coupons->get();
        $coupons = $coupons->paginate(10);
        return view('coupon._table', compact('coupons'));
    }

    public function claim(Request $request)
    {
        if (!$request->has('id')) return abort(404);

        $this->coupon->where('id', '=', $request->input('id'))->update([
            'is_claim' => 1,
            'claim_at' => date('Y-m-d H:is'),
            'claim_media' => 'Web'
        ]);
    }
}
