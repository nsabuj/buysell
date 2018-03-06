@extends('layouts.app')

@section('content')
    <section class="section single-wrap">
        <div class="background-overlay"></div>
        <div class="container position-relative">
            <div class="cat-page-title">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">

                        <h3>Buy/Sell Marketplace</h3>
                        <p class="blog-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <ul id="menu-home-menu" class="home-menu-items"><li id="menu-item-249" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-249"><a href="http://theme-stall.com/catalog/my-account/">Create Store</a></li>
                            <li id="menu-item-247" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-247"><a href="http://theme-stall.com/catalog/upload-new-2/">Advertise your product</a></li>
                            <li id="menu-item-248" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-248"><a href="http://theme-stall.com/catalog/our-services/">Have any question?</a></li>
                        </ul>

                    </div>
                </div>
            </div>



            <div class="content-before">
                <div class="row">
                    <div class="col-md-12 col-sx-12 cen-xs">
                        <form class="dropForm" method="get" id="searchform" role="search" action="/">


                            <div class=" form-group filter hide">
                                {{--<input type="hidden" name="selected_search" id="selected_search">--}}
                                <label for="search_name">Search by</label>
                                <select name="search_name" class="form-control">
                                    <option value="">Select an option</option>
                                    <option value="cat">Category</option>
                                    <option value="city">City</option>
                                </select>

                            </div>

                            <div class=" form-group checkRadioContainer filter hide">
                                <label>
                                    <input type="radio" name="sortby" value="recent" />
                                    <i class="fa fa-check"></i>
                                    <span>Sort by Recent Upload</span>
                                </label>
                                <label>
                                    <input type="radio" name="sortby" value="cheap"/>
                                    <i class="fa fa-check"></i>
                                    <span>Sort by Cheap Price</span>
                                </label>

                            </div>

                            <div class="input-prepend">
                                <input type="text" value="" name="search" id="search" class="form-control" placeholder="Search anything here.">
                                <button class="btn btn-primary search-submit" tabindex="-1" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="serach-filter">
                                <a class="btn btn-primary btn-md filter_button" href="#"><i class="fa fa-random" aria-hidden="true"></i> Advanced Filter</a>

                            </div>
                        </form>
                    </div>
                </div><!-- end row -->
            </div><!-- end content before -->

            <div class="content-products">

     @foreach($ads as $ad)
                    <div class="row">
                    <div class="col-md-12">
                        <div class="item-product">
                            <div class="item-box">
                              <div class="row">
                                <div class="col-md-3">
                                <div class="item-media item-{{$ad->category->name}} entry">

                                    <a href="/single-ad/{{$ad->id}}">

                                        <span class="background-overlay-img"></span><img src="{{asset('/').ad_single_image($ad->photos)}}" alt="product_09">        </a>


                                </div>
                                </div>

                                  <div class="col-md-9">
                                      <div class="full-width"><p class="posted_date">{{ Carbon\Carbon::parse($ad->created_at)->format('d-m-Y H:i') }}</p></div>
                                      <div class="full-width"><h4><a href="/single-ad/{{$ad->id}}">{{$ad->title}}</a></h4></div>
                                {{--<small class="wcvendors_sold_by_in_loop">Sold By <a href="http://theme-stall.com/catalog/vendors/wooteam/">wooteam</a></small><br>  --}}
                                  <div class="full-width">
                                  <div class="haif-width">
                                  <small><i class="fa fa-eye"></i>325</a></small>

                                  </div>
                                      <div class="haif-width">
                                      <div class="product_price">
                                          <p>
                                              <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>{{$ad->price}}</span></p>
                                      </div>
                                      </div>
                                 </div>
                                  </div>
                                  </div>
                            </div>

                        <div>
                    </div>
                </div>
            </div>
                    </div>
@endforeach
{{$ads->links()}}

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
