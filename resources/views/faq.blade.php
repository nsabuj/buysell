@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3>FAQS</h3>
            <div class="panel-group wrap" id="bs-collapse">

                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#bs-collapse" href="#one">

                                What is Buy/sell?
                            </a>
                        </h4>
                    </div>
                    <div id="one" class="panel-collapse collapse">
                        <div class="panel-body">

                            Where now are the horse and the rider? Where is the horn that was blowing? Where is the helm and the hauberk, and the bright hair flowing?
                        </div>
                    </div>

                </div>
                <!-- end of panel -->

                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#bs-collapse" href="#two">
                                How to use it ?
                            </a>
                        </h4>
                    </div>
                    <div id="two" class="panel-collapse collapse">
                        <div class="panel-body">

                            Where is the harp on the harpstring, and the red fire glowing? Where is the spring and the harvest and the tall corn growing?

                        </div>

                    </div>
                </div>
                <!-- end of panel -->
                
                <!-- end of panel -->

                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#bs-collapse" href="#four">
                                Where to start?
                            </a>
                        </h4>
                    </div>
                    <div id="four" class="panel-collapse collapse in">
                        <div class="panel-body">

                            They have passed like rain on the mountain, like a wind in the meadow; The days have gone down in the West behind the hills into shadow.
                        </div>
                    </div>
                </div>
                <!-- end of panel -->


                <div class="faqHeader">Buyers</div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">I want to buy a product - what are the steps?</a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            Buying a theme on <strong>PrepBootstrap</strong> is really simple. Each theme has a live preview.
                            Once you have selected a theme or template, which is to your liking, you can quickly and securely pay via Paypal.
                            <br />
                            Once the transaction is complete, you gain full access to the purchased product.
                        </div>
                    </div>
                </div>

            <!-- end of #bs-collapse  -->

                <div class="faqHeader">Sellers</div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Who cen sell items?</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            Any registed user, who presents a work, which is genuine and appealing, can post it on <strong>PrepBootstrap</strong>.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">I want to sell my items - what are the steps?</a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            The steps involved in this process are really simple. All you need to do is:
                            <ul>
                                <li>Register an account</li>
                                <li>Activate your account</li>
                                <li>Go to the <strong>Themes</strong> section and upload your theme</li>
                                <li>The next step is the approval step, which usually takes about 72 hours.</li>
                            </ul>

                </div>

        </div>
       </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">Why sell my items here?</a>
                </h4>
            </div>
            <div id="collapseSix" class="panel-collapse collapse">
                <div class="panel-body">
                    There are a number of reasons why you should join us:
                    <ul>
                        <li>A great 70% flat rate for your items.</li>
                        <li>Fast response/approval times. Many sites take weeks to process a theme or template. And if it gets rejected, there is another iteration. We have aliminated this, and made the process very fast. It only takes up to 72 hours for a template/theme to get reviewed.</li>
                        <li>We are not an exclusive marketplace. This means that you can sell your items on <strong>PrepBootstrap</strong>, as well as on any other marketplat
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight">What are the payment options?</a>
                </h4>
            </div>
            <div id="collapseEight" class="panel-collapse collapse">
                <div class="panel-body">
                    The best way to transfer funds is via Paypal. This secure platform ensures timely payments and a secure environment.
                </div>
            </div>
        </div>

        </div>

        </div>

    </div>
    <!-- end of container -->


@endsection