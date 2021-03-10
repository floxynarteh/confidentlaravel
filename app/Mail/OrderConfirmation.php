<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmation extends Mailable{
    use Queueable, SerializesModels;

    /**
     * @var \App\Models\Order
     */

    public $order;

    /**
     * @return void
     */
    public function __construct(\App\Models\Order $order){
        $this->order = $order;
    }
   /**
    * @return $this
    */

    public function build(){
        return $this->view('emails.html.product-'. $this->order->product->id)
        ->text('emails.text.product-'. $this->order->product->id)
        ->with(['product' => $this->order->product])
        ->subject('Your Confident Laravel' . $this->order->product->name);

    }
}
