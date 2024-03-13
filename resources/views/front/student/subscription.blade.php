<main id="data-rand">
            <form action="{{route('student.stripe.post')}}" method="POST" id="createFrm">
                @csrf
                <input type="hidden" name="pair_id" id="pair_id" value="{{$pair_id}}">
                <input type="hidden" name="price" value="{{$value}}">
                <input type="hidden" name="data" value="{{$datas}}">
                <input type="hidden" name="classes" value="{{$classes}}">
                <div class="row">
                    <aside class="col-sm-6 offset-3">
                        <article class="card">
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error1"></p>
                            <div class="card-body p-5">
                                <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
                                        <i class="fa fa-credit-card"></i> Credit Card / Debit Card1</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="nav-tab-card">
                                            <div class="form-group">
                                                <label for="username">Full name (on the card)</label>
                                                <input type="text" class="form-control" name="fullName" placeholder="Full Name">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-fullName"></p>
                                            </div>
                                            <div class="form-group">
                                                <label for="cardNumber">Card number</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="cardNumber" placeholder="Card Number">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text text-muted">
                                                        <i class="fab fa-cc-visa fa-lg pr-1"></i>
                                                        <i class="fab fa-cc-amex fa-lg pr-1"></i>
                                                        <i class="fab fa-cc-mastercard fa-lg"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-cardNumber"></p>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label><span class="hidden-xs">Expiration</span> </label>
                                                        <div class="input-group">
                                                            <select class="form-control" name="month">
                                                                <option value="">MM</option>
                                                                @foreach(range(1, 12) as $month)
                                                                    <option value="{{$month}}">{{$month}}</option>
                                                                @endforeach
                                                            </select>
                                                            <select class="form-control" name="year">
                                                                <option value="">YYYY</option>
                                                                @foreach(range(date('Y'), date('Y') + 10) as $year)
                                                                    <option value="{{$year}}">{{$year}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-year"></p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label data-toggle="tooltip" title=""
                                                            data-original-title="3 digits code on back side of the card">CVV <i
                                                            class="fa fa-question-circle" title='The CVV number, or Card Verification Value, is a 3 digit code located on the back of the debit card and is used to complete online transactions.' ></i></label>
                                                        <input type="number" class="form-control" placeholder="CVV" name="cvv">
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-cvv"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-data">
                                                <button class="btn btn-primary btn-block" type="submit"> Confirm </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </aside>
                </div>
            </form>
            </main>