<?php

namespace App\Http\Controllers\Front\student;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use App\Models\BillingDetail;
use App\Models\Credit;
use App\Models\CreditLog;
use App\Models\PurchaseClass;
use App\Models\CouponCode;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mail;
use Session;
use Stripe\PaymentMethod;


class StripeController extends Controller
{
    private $stripe;

    public function __construct()
    {
        $stripeSecretKey = config('stripe.api_keys.secret_key');
        $this->stripe = new StripeClient($stripeSecretKey);
    }

    public function payment(Request $request)
    {
        // dd($request->all());
        $rules = [
            'fullName' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'cardNumber' => 'required|min:1|max:16|regex:/[0-9]{5}/',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required|min:3|max:3'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }

        $user_id = Auth::user()->id;

        $course_id = explode('|',$request->data);
            //order
            $order = new PurchaseClass;
            $order->order_no = 'Intercambio'.time();
            $order->user_id = $user_id;
            $order->course_id = $course_id[0];
            $order->batch_id = $course_id[1];
            $order->batch_name =  $course_id[2];
            $order->amount = $request->price;
            $order->total_class = $request->classes;
            $order->payment_method = 'Stripe';
            $order->status = 1;
            $order->save();

            $order_no = $order->order_no;

            $order_id = $order->id;

        $token = $this->createToken($request->only('cardNumber', 'month', 'year', 'cvv'));
        if (!empty($token['error'])) {
            $request->session()->flash('danger', $token['error']);
            return response()->json([
                'success' => false,
                'errors' => 'Invalid Card Details!'
            ]);
        }
        if (empty($token['id'])) {
            return response()->json([
                'success' => false,
                'errors' => 'payment failed'
            ]);
        }

        $price = $request->price * 100;

        $plan = $this->createPlan($price, $order_id);
        // dd($plan);
        if (!empty($plan) && $plan['active'] == true) {
            $charge = $this->createSubscription(Auth::user(), $token['id'], $plan['id']);
            // dd($charge);
            if (!empty($charge) && $charge['status'] == 'active') {
                
                $query_update =  DB::table('purchase_classes')
                    ->where('id', $order_id)
                    ->update([
                    'stripe_order_id' => $charge['id'],
                    'payment_type' => 'subscription',
                    'is_completed' => '1'
                ]);

                $current_time  = new \DateTime(date('Y-m-d H:i:s'), new \DateTimeZone('Asia/Kolkata'));
                $current_time->setTimezone(new \DateTimeZone('UTC'));
                $current_time1 = $current_time;

                $oneMonthLater = $current_time->modify('+1 month');

                $data = [
                    'order_id' => $order_id,
                    'subscription_id' => $charge['id'],
                    'user_id' => $user_id,
                    'course_id' => $course_id[0],
                    'batch_id' => $course_id[1],
                    'batch_name' =>  $course_id[2],
                    'amount' => $request->price,
                    'status' => 1,
                    'purchase_at' => date('Y-m-d H:i:s'),
                    'next_payment' => $oneMonthLater,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
    
                $sub = DB::table('subscription_credits')->insertGetId($data);

                if($request->pair_id != null){
                    $data2 = [
                        'pairing_id' => $request->pair_id,
                        'order_id' => $order_id,
                        'subscription_id' => $sub,
                        'user_id' => $user_id,
                        'amount' => $request->price,
                        'status' =>  0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
        
                    DB::table('student_pairings')->insert($data2);
                }else{
                    $data2 = [
                        'order_id' => $order_id,
                        'subscription_id' => $sub,
                        'user_id' => $user_id,
                        'amount' => $request->price,
                        'status' =>  1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
        
                    DB::table('student_pairings')->insert($data2);
                }
                DB::table('teacher_pairings')->where('id',$request->pair_id)->update(['payment_status'=>'paid']);


                $email=[
                    'sender_email' => Auth::user()->email,
                    'inext_email' => env('MAIL_USERNAME'),
                    'name'=>Auth::user()->name,
                    'batch' => $course_id[2],
                    'amount' => $request->price
                ];
                Mail::send('mail.student-s03', $email, function ($messages) use ($email) {
                    $messages->to($email['sender_email'])
                        ->from($email['inext_email'], 'Intercambio');
                    $messages->subject("thank you for your payment!");
                });

                return response()->json([
                    'success' => true,
                ]);
            } else {
                return response()->json([
                    'success' => 1,
                    'errors' => 'payment failed2'
                ]);
            }
        }else{
            return response()->json([
                'success' => 1,
                'errors' => 'payment failed2'
            ]); 
        }
            return response()->json([
                'success' => true,
            ]);
    }

    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = \Stripe\Token::create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ], ['api_key' => env('STRIPE_KEY')]);
        } catch (\Stripe\Exception\CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (\Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }


    private function createPlan($amount, $order)
    {

        $charge = null;
        try {
            $product = $this->stripe->products->create([
                'name' => 'Intercambio',
            ]);

            $productId = $product->id;

            $charge = $this->stripe->plans->create([
                'amount' => $amount,
                'currency' => 'usd',
                'interval' => 'month',
                'product' => $productId,
              ]);

        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }

    private function createSubscription($user, $tokenId, $planId)
    {
        try {
            // Retrieve the customer's Stripe ID
            $customer = $this->getStripeCustomerId($user);
            // dd($customer);
            \Stripe\Stripe::setApiKey(config('stripe.api_keys.secret_key'));
            // Convert token to PaymentMethod
            $paymentMethod = PaymentMethod::create([
                'type' => 'card',
                'card' => [
                    'token' => $tokenId,
                ],
            ]);

            // PaymentMethod::attach($paymentMethod->id,['customer'=>Auth::user()->id]);
            $this->stripe->paymentMethods->attach($paymentMethod->id,['customer'=>$customer]);
            // dd($paymentMethod);
            // Create a subscription
            $subscription = $this->stripe->subscriptions->create([
                'customer' => $customer,
                'items' => [
                    ['price' => $planId],
                ],
                'default_payment_method' => $paymentMethod->id,
            ]);
    
            return $subscription;
        } catch (Exception $e) {
            // dd($e->getMessage());
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    private function getStripeCustomerId($user)
    {
        $stripeCustomerId = $user->stripe_customer_id;
        // dd($stripeCustomerId);

        if (!$stripeCustomerId) {
            // If the Stripe Customer ID is not stored in the database, create a new customer on Stripe
            $customer = $this->stripe->customers->create([
                'email' => $user->email,
            ]);

            // Save the Stripe Customer ID in the database
            $user->stripe_customer_id = $customer->id;
            $user->save();

            $stripeCustomerId = $customer->id;
        }

        return $stripeCustomerId;
    }
}
