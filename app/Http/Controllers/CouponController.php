<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function show(Request $request, $code)
    {
        $coupon = Coupon::where('code', $code)->whereNull('expired_at')->first();
        if ($coupon && !$coupon->wasAlreadyUsed($request->user())){
            $request->session()->put('coupon_id', $coupon->id);
        }
        return redirect('/#buy-now');
    }
}
