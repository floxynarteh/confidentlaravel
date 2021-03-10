<?php

namespace App\Services;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PaymentGateway{

    use HasFactory;
    public function charge(string $token, Order $order ){


        Stripe::setApiKey(config('services.stripe.secret'));

        $charge = Charge::create([
            "amount" => $order->totalInCents(),
            "currency" => "usd",
            "source" => $token,
            "description" => "Confident Laravel - " . $order->product->name,
            "receipt_email" => request()->get('stripeEmail')
        ]);
        return $charge;
    }
}
