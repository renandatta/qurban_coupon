<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Period;
use App\User;
use App\UserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|min:4|max:255',
            'password' => 'required|min:3|:max:255'
        ]);

        $user = User::where('email', '=', $request->input('email'))->first();
        if (empty($user)) return response()->json(['error' => 'Email salah !']);
        if (Hash::check($request->input('password'), $user->password)) {
            $token = Str::random(16);
            UserAuth::create([
                'user_id' => $user->id,
                'auth' => 'login',
                'token' => $token
            ]);
            $user->token = $token;
            return response()->json(['success' => $user]);
        }
        return response()->json(['error' => 'Password Salah !']);
    }

    public function logout(Request $request)
    {
        $userAuth = UserAuth::where('token', '=', $request->input('token'))->update(['auth' => 'logout']);
        return response()->json(['success' => $userAuth]);
    }

    public function period_search(Request $request)
    {
        if (!$request->has('token')) return response()->json(['error' => 'Parameter Tidak Sesuai !']);
        $userAuth = UserAuth::where('token', '=', $request->input('token'))
            ->where('auth', '=', 'login')
            ->first();
        if (empty($userAuth)) return response()->json(['error' => 'Token Kadaluarsa !']);
        $periods = Period::orderBy('id', 'desc')->get();
        foreach ($periods as $key => $period) {
            $periods[$key]->coupon_total = Coupon::where('period_id', '=', $period->id)->count();
            $periods[$key]->claimed = Coupon::where('period_id', '=', $period->id)->where('is_claim', '=', 1)->count();
        }
        return response()->json(['success' => $periods]);
    }

    public function claim(Request $request)
    {
        if (!$request->has('token')) return response()->json(['error' => 'Parameter Tidak Sesuai !']);
        $userAuth = UserAuth::where('token', '=', $request->input('token'))
            ->where('auth', '=', 'login')
            ->first();
        if (empty($userAuth)) return response()->json(['error' => 'Token Kadaluarsa !']);
        if (!$request->has('period_id') || !$request->has('no_coupon'))
            return response()->json(['error' => 'Parameter Tidak Sesuai !']);
        if (Coupon::where('period_id', '=', $request->input('period_id'))->count() == 0)
            return response()->json(['error' => 'Kupon tidak ditemukan']);
        $check = Coupon::where('period_id', '=', $request->input('period_id'))
            ->where('is_claim', '=', 0)
            ->where('no_coupon', '=', $request->input('no_coupon'))
            ->count();
        if ($check == 0)
            return response()->json(['error' => 'Kupon sudah diclaim']);
        $coupon = Coupon::where('period_id', '=', $request->input('period_id'))
            ->where('no_coupon', '=', $request->input('no_coupon'))
            ->update([
                'is_claim' => 1,
                'claim_at' => date('Y-m-d') . ' ' . date('H:i:s'),
                'claim_media' => 'Android'
            ]);
        return response()->json(['success' => $coupon]);
    }
}
