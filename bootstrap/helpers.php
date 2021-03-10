<?php

function hasCoupon()
{
    return session()->has('coupon_id');
}

function coupon()
{
    return \App\Models\Coupon::find(session('coupon_id'));
}

