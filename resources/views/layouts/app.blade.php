<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
    <!-- header section start -->

        <header class="header ">
            <div class="container">
                <a href="/" class="header__logo">Buy sell</a>
                 <ul class="header-nav">
                     <li class="header-nav__item"><a class="header-nav__link" href="/"><i class="icon-login"></i> Home</a></li>
                     <li class="header-nav__item"><a class="header-nav__link" href="/about"><i class="icon-login"></i> About Us</a></li>
                     <li class="header-nav__item"><a class="header-nav__link" href="/faq"><i class="icon-login"></i> FAQ</a></li>
                     <li class="header-nav__item"><a class="header-nav__link" href="/contact"><i class="icon-login"></i> Contact</a></li>
                    @if (Auth::check())

                        <li class="header-nav__item"><a class="header-nav__link" data-action="login-signup" href="{{ url('/myaccount') }}">My Account</a></li>
                    @else

                    <li class="header-nav__item"><a class="header-nav__link" href="/login" data-action="login-signup"><i class="icon-login"></i> Login</a></li>
                    <li class="header-nav__item"><a class="header-nav__link" href="/register" data-action="login-signup"><i class="icon-user"></i> Create Account</a></li>
                   @endif
                </ul>
            </div>
        </header>







        @yield('content')
    </div>

    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
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
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="copyright-info">
                         <p class="copy-right">© Catalog INC. All Rights Reserverd. </p>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="custom-menu-links">
                       <ul class="footer-page-nav">
                           <li><a href="/">Home</a> </li>
                           <li><a href="/about">About</a> </li>
                           <li><a href="/faq">Faq</a> </li>
                           <li><a href="/contact">Contact</a> </li>
                       </ul>
                   </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function () {
        $('.collapse.in').prev('.panel-heading').addClass('active');
        $('#accordion, #bs-collapse')
        .on('show.bs.collapse', function (a) {
            a.preventDefault();
        $(a.target).prev('.panel-heading').addClass('active');
        })
        .on('hide.bs.collapse', function (a) {
            a.preventDefault();
        $(a.target).prev('.panel-heading').removeClass('active');
        });

        /*    */
        $('.filter').addClass('hide');
        $('.filter_button').click(function (e) {
            e.preventDefault();
            $('.filter').toggleClass('hide');
        });
        });
    </script>
</body>
</html>
