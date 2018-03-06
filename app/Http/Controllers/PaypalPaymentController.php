<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\AdvertisementsPhoto;
use App\PaymentDetails;
use Illuminate\Http\Request;
use Paypalpayment;
use View;
use URL;
use Illuminate\Support\Facades\Session;

use Redirect;
use Illuminate\Support\Facades\Input;
class PaypalPaymentController extends Controller
{
    private $_apiContext;

    public function __construct()
    {

        $this->_apiContext = Paypalpayment::ApiContext(config('paypal_payment.Account.ClientId'), config('paypal_payment.Account.ClientSecret'));

    }

    public function index()
    {
        echo "<pre>";

        $payments = Paypalpayment::getAll(array('count' => 1, 'start_index' => 0), $this->_apiContext);

        dd($payments);
    }

    public function show($payment_id)
    {
        $payment = Paypalpayment::getById($payment_id,$this->_apiContext);

        dd($payment);
    }

    public function create_card($id)
    {
        $ad_id=$id;
        $ad=Advertisement::find($id);
       // $ad_paid=Advertisement::find($id)->payment_details->status;
        if($ad->payment_details && $ad->payment_details->status=='1') {
            return redirect('/seller/my_ads');
        }else {
            return View::make('advertisement.card', compact('ad_id'));
        }
    }
    public function create_paypal($id)
    {
        $ad_id=$id;
          $ad=Advertisement::find($id);
        if($ad->payment_details && $ad->payment_details->status=='1') {
            return redirect('/seller/my_ads');
        }else {
            $ad_details = Advertisement::find($ad_id);
            $photos = AdvertisementsPhoto::get()->where('advertisement_id', $ad_id);
            $number_of_images = count($photos);


       $options=new AdminOption();
        $price=$options->getoption('price_per_ad');
        $price=(float)$price;
        $ext_img_rate= $options->getoption('extra_price_per_extra_image');
        $ext_img_rate=(float)$ext_img_rate;
         if($number_of_images>2)
            {
                $extra_image=$number_of_images-2;
                $ext_price=$extra_image*$extra_image;
                $price=$price+$ext_price;
            }
            
            $ad_details->payable = $price;

            return View::make('advertisement.paypal', compact('ad_details'));
        }
    }
    /*
    * Process payment using credit card
    */
    public function store_card(Request $request)
    {

//        $addr= Paypalpayment::address();
//        $addr->setLine1("3909 Witmer Road");
//        $addr->setLine2("Niagara Falls");
//        $addr->setCity("Niagara Falls");
//        $addr->setState("NY");
//        $addr->setPostalCode("14305");
//        $addr->setCountryCode("US");
//        $addr->setPhone("716-298-1822");


        $ad_details=Advertisement::find($request->ad_id);
        $photos=AdvertisementsPhoto::get()->where('advertisement_id',$request->ad_id);
        $number_of_images=count($photos);

       $options=new AdminOption();
        $price=$options->getoption('price_per_ad');
        $price=(float)$price;
        $ext_img_rate= $options->getoption('extra_price_per_extra_image');
        $ext_img_rate=(float)$ext_img_rate;
         if($number_of_images>2)
            {
                $extra_image=$number_of_images-2;
                $ext_price=$extra_image*$extra_image;
                $price=$price+$ext_price;
            }
        // ### CreditCard
        $card = Paypalpayment::creditCard();
        $card->setType("visa")
            ->setNumber($request->card_number)
            ->setExpireMonth($request->expiry_month)
            ->setExpireYear($request->expiry_year)
            ->setCvv2($request->cvv)
            ->setFirstName($request->card_first_name)
            ->setLastName($request->card_last_name);


        $fi = Paypalpayment::fundingInstrument();
        $fi->setCreditCard($card);


        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("credit_card")
            ->setFundingInstruments(array($fi));

        $item1 = Paypalpayment::item();
        $item1->setName($ad_details->title)
            ->setDescription($ad_details->description)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setTax(0)
            ->setPrice($price);



        $itemList = Paypalpayment::itemList();
        $itemList->setItems(array($item1));

//
        $details = Paypalpayment::details();
        $details->setShipping(0)
            ->setTax(0)
            //total of items prices
            ->setSubtotal($price);

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")

            ->setTotal($price)
            ->setDetails($details);



        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Billing for advertising , advertisement id:".$request->ad_id)
            ->setInvoiceNumber(uniqid());



        $payment = Paypalpayment::payment();

        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setTransactions(array($transaction));
        Session::put('ad_id', $request->ad_id);
        try {

            $payment->create($this->_apiContext);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
//            return  "Exception: " . $ex->getMessage() . PHP_EOL;
//            exit(1);
            return redirect('/seller/card/'.$request->ad_id)->with('error', 'Please try again with valid information');
        }

//        dd($payment);
        if ($payment->getState() == 'approved') { // payment made
            $this->save_stats($payment);
            return Redirect('/seller/my_ads')
                ->with('success', 'Payment success');
        }
        return Redirect('/seller/my_ads')
            ->with('error', 'Payment failed');

    }


    public function paypal_payment(Request $request)
    {
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = Paypalpayment::item();
        $item_1->setName($request->ad_title)// item name
        ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->total_price);// unit price

        // add item to list
        $item_list =Paypalpayment::itemList();
        $item_list->setItems(array($item_1));
        $amount = Paypalpayment::amount();
        $amount->setCurrency('USD')
            ->setTotal($request->total_price);
        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Payment for advertising');
        $redirect_urls =Paypalpayment::redirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status'))
            ->setCancelUrl(URL::route('payment.status'));
        $payment =Paypalpayment::payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_apiContext);
//            $payment = Paypalpayment::getById($paymentId, $this->_apiContext);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());
        Session::put('ad_id', $request->ad_id);



        if(isset($redirect_url)) {
            // redirect to paypal
            return Redirect::away($redirect_url);
        }
        return Redirect::route('original.route')
            ->with('error', 'Unknown error occurred');
    }



public function satus_paypal(){


    $payment_id = Input::get('paymentId');
    // clear the session payment ID
    Session::forget('paypal_payment_id');
    if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
        return Redirect::route('original.route')
            ->with('error', 'Payment failed');
    }
//    $payment = Payment::get($payment_id, $this->_api_context);
    $payment = Paypalpayment::getById($payment_id, $this->_apiContext);

    $execution = Paypalpayment::PaymentExecution();
    $execution->setPayerId(Input::get('PayerID'));
    //Execute the payment
    $result = $payment->execute($execution,$this->_apiContext);

//echo '<pre>';print_r($result);echo '</pre>';
    //dd($result['tranactions']);

//    exit; // DEBUG RESULT, remove it later
    if ($result->getState() == 'approved') { // payment made
        $this->save_stats($result);
        return Redirect::route('original.route')
            ->with('success', 'Payment success');
    }
    return Redirect::route('original.route')
        ->with('error', 'Payment failed');
}

public function save_stats($result){
$payment_method= $result->payer->payment_method;

  $ad_id=Session::get('ad_id');

 $amount=$result->transactions[0]->amount->total;
    $title=$result->transactions[0]->item_list->items[0]->name;
$payment_id=$result->id;

    PaymentDetails::create([
        'advertisement_id' => $ad_id,
        'title'=> $title,
        'amount' => $amount,
        'status' => '1',
        'payment_id' => $payment_id,
        'payment_method' => $payment_method

    ]);

}


}
