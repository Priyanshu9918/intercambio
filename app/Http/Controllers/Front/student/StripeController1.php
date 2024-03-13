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

class StripeController1 extends Controller
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
    }
    public function pay_bal(Request $request)
    {
        $id = $request->id;
        $t_pair = DB::table('teacher_pairings')->where('id',$id)->first();
        $c_id = DB::table('courses')->where('course_id',$t_pair->course_id)->first();
        $class_type = DB::table('teachers')->where('user_id',$t_pair->teacher_id)->first();

        return view('front.student-pairing-pay',compact('class_type','t_pair','c_id'));
    }
    public function dstripe(Request $request)
    {
        $value = $request->value;
        $classes = $request->classes;
        $type = $request->type;
        $datas = $request->datas;
        $pair_id = $request->pair_id;
        if($type == 'subscription'){
            return view('front.student.subscription',compact('value','classes','type','datas','pair_id'));
        }
        if($type == 'basic'){
            return view('front.student.stripe-basic',compact('value','classes','type','datas','pair_id'));
        }
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

            //order
            $course_id = explode('|',$request->data);

            $order = new PurchaseClass;
            $order->order_no = 'Intercambio'.time();
            $order->user_id = $user_id;
            $order->course_id = $course_id[0];
            $order->batch_id = $course_id[1];
            $order->batch_name =  $course_id[2];
            $order->total_class = $request->classes;
            $order->amount = $request->price;
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


        $charge = $this->createCharge($token['id'], $price, $order_id);
        // dd($charge);
        if (!empty($charge) && $charge['status'] == 'succeeded') {

            $query_update =  DB::table('purchase_classes')
                ->where('id', $order_id)
                ->update([
                'stripe_order_id' => $charge['id'],
                'payment_type' => 'term basis',
                'is_completed' => '1'
            ]);
            if($request->pair_id != null){
                $data = [
                    'pairing_id' => $request->pair_id,
                    'order_id' => $order_id,
                    'user_id' => $user_id,
                    'amount' => $request->price,
                    'status' =>  0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
    
                DB::table('student_pairings')->insert($data);
            }else{
                $data = [
                    'order_id' => $order_id,
                    'user_id' => $user_id,
                    'amount' => $request->price,
                    'status' =>  1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
    
                DB::table('student_pairings')->insert($data);
            }
            DB::table('teacher_pairings')->where('id',$request->pair_id)->update(['payment_status'=>'paid']);


            $email=[
                'sender_email' => Auth::user()->email,
                'inext_email' => env('MAIL_USERNAME'),
                'name'=> Auth::user()->name,
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

    public function createCharge($tokenId, $amount, $order)
    {
        try {
            // Retrieve the customer or create a new one if it doesn't exist
            $customer = $this->retrieveOrCreateCustomer($tokenId);
    
            // Check if the customer has a linked source
            if (!$customer->default_source) {
                return ['error' => 'Customer does not have a linked payment source'];
            }
    
            // Attempt to create a charge using the customer ID
            $charge = $this->stripe->charges->create([
                'amount' => $amount,
                'customer' => $customer->id,
                'currency' => 'USD',
                'source' => $customer->default_source,
                'description' => 'My first payment'
            ]);
            
            return $charge;
        } catch (\Stripe\Exception\CardException $e) {
            // Handle card errors
            return ['error' => 'Card error: ' . $e->getError()->message];
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Handle invalid request errors
            return ['error' => 'Invalid request: ' . $e->getError()->message];
        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Handle authentication errors
            return ['error' => 'Authentication error: ' . $e->getError()->message];
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Handle network errors
            return ['error' => 'Network error: ' . $e->getError()->message];
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle other Stripe API errors
            return ['error' => 'Stripe API error: ' . $e->getError()->message];
        } catch (Exception $e) {
            // Handle other generic errors
            return ['error' => 'Error: ' . $e->getMessage()];
        }
    }
    
    // Helper function to retrieve or create a customer
    private function retrieveOrCreateCustomer($tokenId)
    {
        try {
            // Attempt to retrieve the customer using the provided token
            $customer = $this->stripe->customers->create([
                'source' => $tokenId,
                'email' => Auth::user()->email, // Assuming this fetches the authenticated user's email
                'name' => Auth::user()->name, // Assuming this fetches the authenticated user's name
            ]);
            
            return $customer;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // If the customer already exists, retrieve it instead of creating
            if ($e->getError()->code === 'resource_already_exists') {
                $customer = $this->stripe->customers->retrieve(Auth::user()->stripe_customer_id);
                return $customer;
            } else {
                // Rethrow the exception if it's not due to customer already existing
                throw $e;
            }
        }
    }
    
    public function cancle(Request $request)
    {
        $stripeCustomerId = $request->id;
        // dd($stripeCustomerId);

        if ($stripeCustomerId) {
            $customer = $this->stripe->subscriptions->update($stripeCustomerId, ['cancel_at_period_end' => true]);
            $credit = [
                'status' => 0,
            ];
            DB::table('subscription_credit')->where('user_id',Auth::user()->id)->where('subscription_id',$stripeCustomerId)->update($credit);
            return response()->json([
                'success' => true
            ]);
        }
        return response()->json([
            'success' => false
        ]);

    }
    public function active(Request $request)
    {
        $stripeCustomerId = $request->id;
        // dd($stripeCustomerId);

        if ($stripeCustomerId) {
            $customer = $this->stripe->subscriptions->update($stripeCustomerId, ['cancel_at_period_end' => false]);
            $credit = [
                'status' => 1,
            ];
            DB::table('subscription_credit')->where('user_id',Auth::user()->id)->where('subscription_id',$stripeCustomerId)->update($credit);
            return response()->json([
                'success' => true
            ]);
        }
        return response()->json([
            'success' => false
        ]);
    }
    public function canclesub(Request $request)
    {
        $stripeCustomerId = $request->id;
        // dd($stripeCustomerId);

        if ($stripeCustomerId) {
            // $customer = $this->stripe->subscriptions->update($stripeCustomerId, ['cancel_at_period_end' => false]);
            $customer = $this->stripe->subscriptions->retrieve($stripeCustomerId);
            $customer->cancel();

            $credit = [
                'status' => 2,
            ];
            DB::table('subscription_credit')->where('user_id',Auth::user()->id)->where('subscription_id',$stripeCustomerId)->update($credit);
            return response()->json([
                'success' => true
            ]);
        }
        return response()->json([
            'success' => false
        ]);
    }
}
