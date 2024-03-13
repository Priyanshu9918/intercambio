<div class="modal-body" id="sub_plan">
            <input type="hidden" name="pair_id" id="pair_id" value="{{$t_pair->id}}">
            <input type="hidden" name="plan_data" id="plan_val" value="{{$c_id->id . '|' . $t_pair->batch_id . '|' . $t_pair->batch_name}}">
                {{--<h2 class="fs-5">Term Basis Plan</h2>
                @php
                    $basic_price = DB::table('payments')->where('class_type','Group Class')->where('payment_type','terms basis')->orderBy('created_at','desc')->first();
                @endphp
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="plan_selection"
                        data-value="60" data-type="basic"
                        data-credit="16">
                    <label class="form-check-label">
                        <span>$60 | 16 Classes</span>
                    </label>
                </div>
                <hr>--}}
                <h2 class="fs-5">Subscriptions Plan</h2>
                @php
                $sub_price = DB::table('payments')->where('class_type','Group Class')->where('payment_type','subscriptions')->orderBy('created_at','desc')->first();
                @endphp
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="plan_selection"
                        data-value="50" data-type="subscription" data-credit="0">
                    <label class="form-check-label">
                    {{-- <span>${{$sub_price->fee ?? ''}}</span> --}}
                        <span>$50</span>
                    </label>
                </div>
            </div>