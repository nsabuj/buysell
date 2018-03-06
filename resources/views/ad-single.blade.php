@extends('layouts.app')

@section('content')
    <section class="section single-wrap">
        <div class="background-overlay"></div>
        <div class="container position-relative">
            <div class="cat-page-title">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">

                        <h3>Catalog Marketplace</h3>
                        <p class="blog-description">Hundreds of PSD templates, mobile applications, UI &amp; material elements! Upload your own handmade digital items and make money!</p>
                        <ul id="menu-home-menu" class="home-menu-items"><li id="menu-item-249" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-249"><a href="http://theme-stall.com/catalog/my-account/">Create Store</a></li>
                            <li id="menu-item-247" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-247"><a href="http://theme-stall.com/catalog/upload-new-2/">Upload Work</a></li>
                            <li id="menu-item-248" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-248"><a href="http://theme-stall.com/catalog/our-services/">Our Services</a></li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="content-top">
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <div class="custommenu hidden-xs">
                            <a id="showLeft" href="#" title="" class="bt-menu-trigger"><span></span>
                                <img src="http://theme-stall.com/catalog/wp-content/themes/catalog/images/fav.png" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-12 cen-xs text-right pull-right">
                        <ul class="list-inline social">
                            <li>
                                <a href="#" title="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Google+">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Dribbble">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Behance">
                                    <i class="fa fa-behance"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Pinterest">
                                    <i class="fa fa-pinterest"></i>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div><!-- end row -->
            </div><!-- end content top -->




            <div class="content-product">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ad-details">
                            <img src="{{asset('/').ad_single_image($ad->photos)}}"/>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="ad-title">{{$ad->title}}</h2>

                        <p class="price">${{$ad->price}}</p>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="" class="btn"><i class="fa fa-mobile fa-2x"></i></a>
                                <span>Call seller</span>
                            </div>
                            <div class="col-md-6">
                                <a href="/user/chat/{{$ad->user_id}}/ref_ad/{{$ad->id}}" class="btn"><i class="fa fa-comment fa-2x"></i><span></span> </a>
                            </div>
                        </div>
                        <p class="ad-description">{{$ad->description}}</p>
                    </div>

                </div>

                <div class="row">
                    @foreach($ad->photos as $photo)
                        <div class="col-md-3">
                            <div class="item">
                            <img src="{{asset('/').$photo->filename}}"/>
                            </div>
                        </div>
                    @endforeach
                </div>

                </div>
            </div><!-- end container -->
    </section>

    {{--<section>--}}
    {{--<div class="container">--}}
    {{--<div class="row">--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}



@endsection
