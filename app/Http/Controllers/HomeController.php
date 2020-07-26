<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Period;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $period, $coupon;
    public function __construct(Period $period, Coupon $coupon)
    {
        $this->middleware('auth');
        $this->period = $period;
        $this->coupon = $coupon;
    }

    public function index()
    {
        $periods = $this->period->orderBy('id', 'desc')->get();
        foreach ($periods as $key => $period) {
            $periods[$key]->claimed = $this->coupon->where('period_id', '=', $period->id)
                ->where('is_claim', '=', 1)->count();
            $periods[$key]->not_claimed = $this->coupon->where('period_id', '=', $period->id)
                ->where('is_claim', '=', 0)->count();
        }
        return view('home.index', compact('periods'));
    }
}
