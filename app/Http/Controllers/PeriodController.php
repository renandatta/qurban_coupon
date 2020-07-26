<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PeriodController extends Controller
{
    protected $period;
    public function __construct(Period $period)
    {
        $this->middleware('auth');
        $this->period = $period;
        view()->share('title', 'Periode Qurban');
    }

    public function index()
    {
        Session::put('menu_active', 'period');
        return view('period.index');
    }

    public function search(Request $request)
    {
        $periods = $this->period;
        if ($request->has('name') && $request->input('name') !== '')
            $periods = $periods->where('name', 'like', '%'. $request->input('name') .'%');
        if ($request->has('ajax')) return $periods->get();
        $periods = $periods->paginate(10);
        foreach ($periods as $key => $period) {
            $periods[$key]->is_generate = Coupon::where('period_id', '=', $period->id)->count();
        }
        return view('period._table', compact('periods'));
    }

    public function info(Request $request)
    {
        $period = $request->has('id') ? $this->period->find($request->get('id')) : [];
        return view('period.info', compact('period'));
    }

    public function save(Request $request)
    {
        $period = $request->has('id') ?
            $this->period->where('id', '=', $request->input('id'))
                ->update($request->only('name', 'year')) :
            $this->period->create($request->only('name', 'year'));
        if ($request->has('ajax')) return $period;
        return redirect()->route('period')->with(['success' => 'Periode Qurban Berhasil Disimpan']);
    }

    public function delete(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        $period = $this->period->where('id', '=', $request->input('id'))->delete();
        if ($request->has('ajax')) return $period;
        return redirect()->route('period')->with(['success' => 'Periode Qurban Berhasil Dihapus']);
    }

    public function print_coupon(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        $coupons = Coupon::where('period_id', '=', $request->get('id'))->orderBy('no_coupon', 'asc')->get();

        return view('coupon.print_coupon', compact('coupons'));
    }
}
