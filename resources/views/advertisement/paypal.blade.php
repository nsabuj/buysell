@extends('seller.sellerdashboard')


@section('content')

    {{--<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">--}}
        {{--<input type="hidden" name="cmd" value="_cart">--}}
        {{--<input type="hidden" name="upload" value="1">--}}
        {{--<input type="hidden" name="business" value="nsabuj321-facilitator@gmail.com">--}}
        {{--<input type="hidden" name="item_name_1" value="Item Name 1">--}}
        {{--<input type="hidden" name="amount_1" value="10.00">--}}
        {{--<input type="submit" value="PayPal">--}}
        {{--<input type="hidden" name="notify_url" value="{{ url('/').'/seller/paypal/success'}}">--}}
        {{--<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!">--}}
        {{--<input type="hidden" value="{{ url('/').'/seller/paypal/success'}}" name="return">--}}
        {{--<input type="hidden"  value="{{ url('/').'/seller/paypal/cancel'}}" name="cancel_return">--}}
    <!--</form>-->

    <div class="container"><div class="row"><div class="col-md-12">
     <div class="ad-hint">
         <p> Advertisement Name : <b>{{$ad_details->title}}</b> </p>
         <p> Product Price : ${{$ad_details->price}} </p>
         <h4>Total Payable to post this : ${{$ad_details->payable}} </h4>
     </div>

   <form action="/seller/paypal" method="post" id="paypal_form">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <input type="hidden" name="ad_id" value="{{$ad_details->id}}">
       <input type="hidden" name="ad_title" value="{{$ad_details->title}}">
       <input type="hidden" name="ad_description" value="{{$ad_details->description}}">
       <input type="hidden" name="total_price" value="{{$ad_details->payable}}">
       <a href="#" id="submit_paypal"><img src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/silver-pill-paypal-44px.png" alt="PayPal"></a>
    </form>
            </div> </div> </div>

@endsection
