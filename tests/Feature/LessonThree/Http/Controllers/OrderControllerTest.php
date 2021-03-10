<?php

namespace Tests\Feature\LessonThree\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\PaymentGateway;
// use Newsletter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use App\Exceptions\PaymentGatewayChargeException;
use App\Mail\OrderConfirmation;
use App\Models\Coupon;
use App\Models\User;
// use Stripe\Order;
use Tests\TestCase;
use Stripe\Error\Card;
use Stripe\Exception;
use Stripe\Stripe;
use Stripe\Exception\CardException;
// use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class OrderControllerTest extends TestCase
{
    // use WithoutMiddleware;
    use HasFactory;
    use WithFaker, RefreshDatabase;
  
    /**
     * @test
     */

    public function index_displays_discounted_price_for_coupon(){
        
     $this->withoutExceptionHandling();
       $coupon = Coupon::factory()->create([
           'percent_off' => 10
       ]);
      
       Product::factory()->create([
           'price' => 10
       ]);

      Product::factory()->create([
          'price' => 20
      ]);

       $response = $this->withSession(['coupon_id' => $coupon->id])->get('/');
          
       

       $response->assertOk();
       $response->assertViewIs('orders.index');
       $response->assertViewHasAll(['products','lessons','videos']);

    //    $response->assertSeeText('Buy Now $10 $9');
    //    $response->assertSeeText('Buy Now $20 $18');

        $response->assertSee('Buy Now</span> <s class="opacity-75 font-semibold text-sm">$10</s> $9', false);
        $response->assertSee('Buy Now</span> <s class="opacity-75 font-semibold text-sm">$20</s> $18', false);
           
         

     

 }
   /**
    * @test
    */

    public function store_charges_order_and_create_account(){
  
        //   $this->withoutExceptionHandling();

         $product = Product::factory()->create();
         $token =  $this->faker->md5;   
         $email = $this->faker->safeEmail;
    
         
         //added code
          $charge_id = $this->faker->md5;
        //   dd($charge_id);

         $paymentGateway = $this->mock(PaymentGateway::class);
         $paymentGateway->shouldReceive('charge')
              ->with($token, Mockery::type(Order::class))
              //added code
             ->andReturn($charge_id);


            //   ->andReturn('charge-id');

            //added code

        $event = Event::fake();   
        $mail = Mail::fake(); 


        $response = $this->post(route('order.store'), [
            'product_id' => $product->id,
            'stripeToken' => $token,
            'stripeEmail' => $email,

        ]);

        $response->assertRedirect('/users/edit');
        // $this->markTestIncomplete();
 
        // added code
        $users = User::where('email', $email)->get();
        // dd($users);
        $this->assertSame(1, $users->count());

        $user = $users->first();
        $this->assertAuthenticatedAs($user);
        // dd($user);
        

        $this->assertDatabaseHas('orders', [
            'product_id' => $product->id,
            'total' => $product->price,
            'user_id' => $user->id,
            'stripe_id' => $charge_id
        ]);

        
    

        //added code
        $order = Order::where('stripe_id', $charge_id)->first();
        $event->assertDispatched('order.placed', function($event, $argument) use($order){
            return $argument->id == $order ->id;
    
           });
        $mail->assertSent(OrderConfirmation::class, function($mail) use($order,$user){
            return $mail->order->is($order)
            && $mail->hasTo($user->email);
        });
        
    }


    //sad path when a charge fails

    /**
     * @test
     */


    public function store_return_error_view_when_charge_fails(){
        $product = Product::factory()->create();
                $token = $this->faker->md5;
        
        
                $paymentGateway = $this->mock(PaymentGateway::class);
                $exception = new PaymentGatewayChargeException(
                   'sad path order exception',
                   ['error' => ['data' => 'passed to view']],
               );
        
               $paymentGateway->shouldReceive('charge')
                  ->with($token, Mockery::type(Order::class))
                  ->andThrows($exception);
        
               $response = $this->post(route('order.store'), [
                   'product_id' => $product->id,
                   'stripeToken' => $token,
                   'stripeEmail' => $this->faker->safeEmail,
               ]);
                $response->assertOk();
                $response->assertViewIs('errors.generic');
                $response->assertViewHas('template', 'partials.errors.charge_failed');
                $response->assertViewHas('data', ['data' => 'passed to view']);


    }
}
