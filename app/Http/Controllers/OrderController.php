<?php

namespace App\Http\Controllers;

use App\Exceptions\PaymentGatewayChargeException;
use App\Models\Coupon;
use App\Http\Requests\OrderRequest;
use App\Models\Lesson;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Video;
use App\Services\PaymentGateway ;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use PDOException;
use Stripe\Charge;
use Stripe\Error\Card;
use Stripe\Exception\CardException;
// use Stripe\Exception;
use Stripe\Stripe;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', [
            'products' => Product::paid(),
            // 'lessons' => Lesson::where('product_id', '!=', Product::FULL)->orderBy(),
            // 'videos' => Video::orderBy('ordinal', 'asc')->get()->groupBy('lesson_id'),
            'lessons' => Lesson::course(),
            'videos' => Video::all()->groupBy('lesson_id'),
        ]);
    }

    public function store(OrderRequest $request, PaymentGateway $paymentGateway)
    {

            $product = Product::findOrFail($request->get('product_id'));


            $order = new Order([
                'product_id' => $product->id,
                'total' => $product->price,
            ]);

            $this->applyCoupon($order);

            $charge_id= $paymentGateway->charge($request->get('stripeToken'),$order);

            $user = User::createFromPurchase($request->get('stripeEmail'), $charge_id);

            $order->user_id = $user->id;
            $order->stripe_id = $charge_id;
            $order->save();

            event('order.placed', $order);

            Auth::login($user, true);
            Mail::to($user->email)->send(new OrderConfirmation($order));


        return redirect('/users/edit');
    }

    private function applyCoupon(Order $order)
    {
        if (!Session::has('coupon_id')) {
            return;
        }

        $coupon = Coupon::find(Session::get('coupon_id'));
        if (!$coupon) {
            return;
        }

        if ($coupon->wasAlreadyUsed(Auth::user())) {
            return;
        }

        Session::forget('coupon_id');

        $order->applyCoupon($coupon);
    }
}
