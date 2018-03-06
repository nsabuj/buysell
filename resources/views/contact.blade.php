@extends('layouts.app')

@section('content')
    <section id="contact" style="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <div class="about_our_company" style="margin-bottom: 20px;">
                    <h1 style="color:#fff;">Write Your Message</h1>
                    <div class="titleline-icon"></div>
                    <p style="color:#fff;">Lorem Ipsum is simply dummy text of the printing and typesetting </p>
                </div>
            </div>
            </div>

                @if(session('message'))
    <div class='alert alert-success'>
        {{ session('message') }}
    </div>
    @endif

            <div class="row">
                <div class="col-md-8">
                    <form name="sentMessage" id="contactForm" novalidate="" action="/contact" method="post">
                    {{ csrf_field() }} 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" id="name" required >
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email *" id="email" required>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" >
                                    <p class="help-block text-danger"></p>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" placeholder="subject :*" id="subject" required>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Your Message *" id="message" required ></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>

                                <div class="form-group">
                                    <input type="file" class="form-control inputfile" name="attachment"  id="attachment"  >
                                    <label for="attachment">Attach a file <span style="font-size: 10px;">(2 MB max)</span></label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl get">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <p style="color:#fff;">
                        <strong><i class="fa fa-map-marker"></i> Address</strong><br>
                        1216/Mirpur_10 Beach, Dhaka(Bangladesh)
                    </p>
                    <p style="color:#fff;"><strong><i class="fa fa-phone"></i> Phone Number</strong><br>
                        (+8801)7123456</p>
                    <p style="color:#fff;">
                        <strong><i class="fa fa-envelope"></i>  Email Address</strong><br>
                        Email@info.com</p>
                    <p></p>
                </div>
            </div>
        </div>
    </section>
@endsection