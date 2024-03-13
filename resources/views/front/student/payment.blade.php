@extends('layouts.student.master')
@section('content')
        <style>
            .form-check label {
                font-size: 13px;
                line-height: 20px;
            }
            .form-check-input[type=radio]{
                margin-top: 5px;
            }
            .account-form-input select {
                width: 100%;
                height: 50px;
                line-height: 50px;
                border: 1px solid rgba(4, 0, 23, 0.1);
                border-radius: 6px;
                padding: 0 20px;
                font-size: 14px;
                color: rgba(4, 0, 23, 0.6);
            }
            .historypay .item-h{
                border-bottom: 1px solid #0000001a;
            }
            .historypay .small-text{
                font-size: 12px;
            }
        </style>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                        <div class="account-wrap ">
                                <div class="account-main">
                                    @php 
                                        $payment_history = DB::table('student_pairings')->where('user_id',Auth::user()->id)->get();
                                    @endphp
                                    <form action="#" class="account-form">
                                    <div class="account-form-item mb-15">
                                            <div class="account-form-input account-form-input-pass align-items-center d-flex justify-content-between">
                                                <div>  
                                                <h3 class="account-title mb-0">Payments</h3>
                                                    <p class="mb-0">Total Payment:<b class="text-end">{{count($payment_history)}}</b></p>
                                                </div>
                                                <div class="">  
                                                    <h6 class=" mb-0">Payment Method</h6>
                                                    <p class=" mb-0">Stripe</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="account-form-item mb-15">
                                            <div class="account-form-input account-form-input-pass ">
                                                
                                            </div>
                                        </div>
                                        <div class="account-form-item historypay mb-15">
                                            <div class="account-form-label">
                                                <label class="fs-6">Payment History</label>
                                            </div>
                                            @foreach($payment_history as $key=>$payments)
                                            @php 
                                                $order_data = DB::table('purchase_classes')->where('id',$payments->order_id)->first();
                                            @endphp
                                            <div class="my-2 item-h" >
                                                <div class="account-form-input account-form-input-pass d-flex justify-content-between">
                                                    <div>
                                                        <p class="mb-0 lh-1">{{$order_data->order_no}}</p>
                                                        <p class="mb-0 small-text">{{$payments->created_at}}</p>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0 text-end text-danger lh-1">- ${{$payments->amount}}</p>
                                                        <p class="mb-0 "><b>From -</b> {{$order_data->payment_method}}/{{$order_data->payment_type}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <!-- <div class="my-2 item-h">
                                                <div class="account-form-input account-form-input-pass d-flex justify-content-between">
                                                    <div>
                                                        <p class="mb-0 lh-1">FOOD00054312</p>
                                                        <p class="mb-0 small-text">10/01/2024, 05:10 PM</p>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0 text-end text-danger lh-1">- $500</p>
                                                        <p class="mb-0 "><b>From</b> UPI</p>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <!-- <div class="account-form-button">
                                            <button type="submit" class="account-btn">Subscribe</button>
                                        </div> -->
                                    </form>
                                   
                                </div>
                            </div>
                        </div>
@endsection