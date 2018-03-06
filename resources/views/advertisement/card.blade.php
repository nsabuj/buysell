@extends('seller.sellerdashboard')


@section('content')







<div class="card">          <!-- card pymentt start-->

        <div style="text-align: center;color: red;font-size: 20px;">
       {{session('error')}}
        </div>

    <form class="form-horizontal" role="form" action="/seller/card" method="post">
        {{ csrf_field() }}
        <fieldset>
            <legend>Payment</legend>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="card_first_name">First Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="card_first_name" id="card_first_name" placeholder="First Name" required>
                </div>
                <label class="col-sm-1 control-label" for="card_last_name">Last Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="card_last_name" id="card_last_name" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="card_number">Card Number</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="card_number" id="card_number" placeholder="Debit/Credit Card Number">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="expiry_month">Expiration Date</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-xs-3">
                            <select class="form-control col-sm-2" name="expiry_month" id="expiry_month" required>
                                <option>Month</option>
                                <option value="01">Jan (01)</option>
                                <option value="02">Feb (02)</option>
                                <option value="03">Mar (03)</option>
                                <option value="04">Apr (04)</option>
                                <option value="05">May (05)</option>
                                <option value="06">June (06)</option>
                                <option value="07">July (07)</option>
                                <option value="08">Aug (08)</option>
                                <option value="09">Sep (09)</option>
                                <option value="10">Oct (10)</option>
                                <option value="11">Nov (11)</option>
                                <option value="12">Dec (12)</option>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="expiry_year" required>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="cvv">Card CVV</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="cvv" id="cvv" placeholder="Security Code" required>
                </div>
            </div>
            <div class="form-group">

                <div class="col-sm-offset-3 col-sm-9">
                    <input type="hidden" class="form-control" name="ad_id" id="ad_id" value="{{$ad_id}}" >
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-success proceed_card">Proceed payment</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
@endsection