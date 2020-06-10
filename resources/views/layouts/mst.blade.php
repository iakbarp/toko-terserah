<!DOCTYPE html>
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en">
<![endif]-->
<!--[if gt IE 8]>
<!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="keywords" content="HTML5 Template , Responsive , html5 , css3">
    <meta name="description" content="{{env('APP_TITLE')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">

    <!-- Bootstrap-3.3.7 fremwork css -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/glyphicons.css')}}"/>
    <!-- Core Style css -->
    <link rel="stylesheet" href="{{asset('css/colorbox.css')}}"/>
    <!-- Slider carousel css  -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">
    <!-- Fontawesome 5.10.1 -->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/fontawesome/css/all.css')}}">
    <!-- Main style css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}"/>
    <!-- shop css -->
    <link rel="stylesheet" href="{{asset('css/shop.css')}}">
    <!-- effects css -->
    <link rel="stylesheet" href="{{asset('css/components/effects.css')}}">
    <!-- fancybox css -->
    <link rel="stylesheet" href="{{asset('css/sliders/stylesheet.css')}}">
    <link rel="stylesheet" href="{{asset('css/components/jquery.fancybox.css')}}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <!-- modal -->
    <link rel="stylesheet" href="{{asset('css/modal.css')}}">
    <!-- ajax-loader -->
    <link rel="stylesheet" href="{{asset('css/ajax-loader.css')}}">
    <!-- select2 -->
    <link href="{{asset('vendor/select2/dist/css/select2.css')}}" rel="stylesheet"/>
    <!-- Loading.io -->
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert2.css')}}">
    <link rel="stylesheet" href="{{asset('css/additional.css')}}">
    <!-- Media queries -->
    <link rel="stylesheet" href="{{asset('css/media-query.css')}}">
    @stack('styles')

    <script src='https://www.google.com/recaptcha/api.js?onload=recaptchaCallback&render=explicit' async defer></script>
</head>

<body class="use-nicescroll" data-spy="scroll" data-target="#toc">
<div class="images-preloader">
    <div class="load">
        <hr>
        <hr>
        <hr>
        <hr>
    </div>
</div>

<div class="wrapper">
    <header class="site-header shop-header">
        <div class="sub-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="contacts">
                            <p><a href="tel:+6281252658218"><i class="fa fa-phone fa-flip-horizontal pl-0"></i><b>Telepon:</b>
                                    +62 811-3051-081</a></p>
                            <p><a href="mailto:{{env('MAIL_USERNAME')}}"><i
                                        class="fa fa-envelope"></i><b>Email:</b> {{env('MAIL_USERNAME')}}</a></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="social-media">
                            <a href="https://fb.com/ramadhanwahyu.gonzales" target="_blank">
                                <i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/ramadhanwahyuu5" target="_blank">
                                <i class="fab fa-twitter"></i></a>
                            <a href="https://github.com/Ramadhan1101" target="_blank">
                                <i class="fab fa-github"></i></a>
                            <a href="https://instagram.com/Ramadhan_Wahyu_11" target="_blank">
                                <i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-bar" id="main-bar">
            <div class="container">
                <div class="logo">
                    <a href="{{route('beranda')}}">
                        <img src="{{asset('images/logotype.png')}}" alt="Logo">
                    </a>
                </div>

                <button class="btn-toggle"><i class="fa fa-bars"></i></button>

                @include('layouts.partials._headerMenu')
            </div>
        </div>
    </header>

    <div class="main-content home-page">
        <section class="search-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="categorys">
                            <a href=""><i class="fa fa-align-justify"></i> Kategori Produk</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="search-category">
                                    <div class="input-group">
                                        <div class="input-group-btn search-panel">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <span id="search_concept">Semua Kategori</span> <span
                                                    class="caret"></span>
                                            </button>
                                            <ul class="dropdown-Menu" role="menu">
                                                <li><a href="#">Accessories</a></li>
                                                <li><a href="#">Android</a></li>
                                                <li><a href="#">Bags</a></li>
                                                <li><a href="#">Basketball</a></li>
                                                <li><a href="#">Beer</a></li>
                                                <li><a href="#">Blankets</a></li>
                                                <li><a href="#">Cake</a></li>
                                                <li><a href="#">Computers</a></li>
                                                <li><a href="#">Cream</a></li>
                                                <li><a href="#">Electronis</a></li>
                                                <li><a href="#">Fashion</a></li>
                                                <li><a href="#">Fast Food</a></li>
                                                <li><a href="#">Jewelry</a></li>
                                                <li><a href="#">Iphone</a></li>
                                                <li><a href="#">Shoes</a></li>
                                                <li><a href="#">Sports</a></li>
                                                <li><a href="#">Stools</a></li>
                                                <li><a href="#">T-Shirt</a></li>
                                                <li><a href="#">Table</a></li>
                                                <li><a href="#">Mobiles</a></li>
                                                <li><a href="#">Necklaces</a></li>
                                                <li><a href="#">Rings</a></li>
                                            </ul>
                                        </div>
                                        <input type="hidden" name="search_param" value="all" id="search_param">
                                        <input type="text" class="form-control-2" name="x" placeholder="Search term...">
                                        <span class="input-group-btn">
                                                <button class="btn btn-default color-2" type="button"><span
                                                        class="fa fa-search"></span>
                                            </button>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @yield('content')
    </div>

    <footer class="footer3">
        <div class="content-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="footer-widget widget">
                            <h4 data-toc-skip>Telah Tersedia</h4>
                            <img class="download-phone-ico" src="{{asset('images/phone.png')}}">
                            <div class="download-apps-ico">
                                <a href="https://play.google.com/store/apps/details?id=com.tokoterserah.mobile">
                                    <img class="zoom img-responsive" src="{{asset('images/GooglePlay.png')}}">
                                </a>
                                <hr>
                                <a href="https://itunes.apple.com/id/app/tokoterserah.com/id1143444473?mt=8">
                                    <img class="zoom img-responsive" src="{{asset('images/AppStore.png')}}">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="footer-widget widget">
                            <h4 data-toc-skip>Tautan Lain</h4>
                            <ul class="contact">
                                <li><a href="{{route('tentang')}}"><i class="fa fa-caret-right"></i> Tentang Kami</a>
                                </li>
                                <li><a href="{{route('syarat-ketentuan')}}"><i class="fa fa-caret-right"></i> Syarat &
                                        Ketentuan</a></li>
                                <li><a href="{{route('kebijakan-privasi')}}"><i class="fa fa-caret-right"></i> Kebijakan
                                        Privasi</a></li>
                                <li><a href="{{route('kontak')}}"><i class="fa fa-caret-right"></i> Kontak</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="footer-widget widget">
                            <h4 data-toc-skip>Tetap Terhubung</h4>
                            <ul class="contact">
                                <li>
                                    <i class="fa fa-map-marked-alt" style="color: #fff"></i>
                                    Jl. Raya Lontar No. 46 Surabaya – 60216
                                </li>
                                <li><a href="tel:+628113051081"><i class="fa fa-phone"></i> +62 811-3051-081</a></li>
                                <li><a href="mailto:{{env('MAIL_USERNAME')}}"><i class="fa fa-envelope"></i>
                                        {{env('MAIL_USERNAME')}}</a></li>
                            </ul>
                            <div class="social-media">
                                <a href="https://fb.com/ramadhanwahyu.gonzales" target="_blank">
                                    <i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/ramadhanwahyuu5" target="_blank">
                                    <i class="fab fa-twitter"></i></a>
                                <a href="https://github.com/Ramadhan1101" target="_blank">
                                    <i class="fab fa-github"></i></a>
                                <a href="https://instagram.com/Ramadhan_Wahyu_11" target="_blank">
                                    <i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright-3 mt-0">
                    <div class="row">
                        <div class="container">
                            <div class="col-md-7">
                                <p>© {{now()->format('Y').' '.env('APP_COMPANY')}}. All rights reserved | Designed &
                                    Developed by <a href="http://rabbit-media.net" target="_blank">HEALER DevOps</a></p>
                            </div>
                            <div class="col-md-5">
                                <ul class="footer-menu none-style">
                                    <li><a href="#"><img src="{{asset('images/shop/cards/1.png')}}" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('images/shop/cards/2.png')}}" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('images/shop/cards/3.png')}}" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('images/shop/cards/4.png')}}" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('images/shop/cards/5.png')}}" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

@include('layouts.partials._signUpIn')

<div id="gotoTop" class="fa fa-arrow-up"></div>
<div class="myProgress">
    <div class="bar"></div>
</div>

<!-- Jquery -->
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.fancybox.js')}}"></script>
<script type="text/javascript">
    function getTimeRemaining(endtime) {
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor((t / 1000) % 60);
        var minutes = Math.floor((t / 1000 / 60) % 60);
        var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };
    }

    function initializeClock(id, endtime) {
        var clock = document.getElementById(id);
        var daysSpan = clock.querySelector('.days');
        var hoursSpan = clock.querySelector('.hours');
        var minutesSpan = clock.querySelector('.minutes');
        var secondsSpan = clock.querySelector('.seconds');

        function updateClock() {
            var t = getTimeRemaining(endtime);

            daysSpan.innerHTML = t.days;
            hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
            minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
            secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

            if (t.total <= 0) {
                clearInterval(timeinterval);
            }
        }

        updateClock();
        var timeinterval = setInterval(updateClock, 1000);
    }

    var deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
    initializeClock('clockdiv', deadline);
</script>
<!-- Bootstrap js -->
<script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
<!-- Carousel Slider js -->
<script type="text/javascript" src="{{asset('js/owl.carousel.min.js')}}"></script>
<!-- Jquery accordion  js -->
<script type="text/javascript" src="{{asset('js/smk-accordion.js')}}"></script>
<script type="text/javascript" src="{{asset('js/visible.min.js')}}"></script>
<!-- counter up Requires js -->
<script type="text/javascript" src="{{asset('js/waypoints.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.easing.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.counterup.min.js')}}"></script>
<!-- Jquery progressbar js -->
<script type="text/javascript" src="{{asset('js/pro-bars.js')}}"></script>
<script type="text/javascript" src="{{asset('js/classie.js')}}"></script>
<!-- wow animate js -->
<script type="text/javascript" src="{{asset('js/wow.js')}}"></script>
<!-- Jquery about js -->
<script type="text/javascript" src="{{asset('js/index-shop.js')}}"></script>
<!-- Jquery progressbar  js -->
<script type="text/javascript" src="{{asset('js/progressbar.js')}}"></script>
<!-- Top Header fixed js -->
<script type="text/javascript" src="{{asset('js/header-fixed.js')}}"></script>

<!-- modal -->
<script src="{{asset('js/modal.js')}}"></script>
<!-- toggle password -->
<script src="{{asset('js/hideShowPassword.min.js')}}"></script>
<!-- jquery-maskMoney -->
<script src="{{asset('js/jquery.maskMoney.js')}}"></script>
<!-- select2 -->
<script src="{{asset('vendor/select2/dist/js/select2.full.min.js')}}"></script>
<!-- check-mobile -->
<script src="{{asset('vendor/checkMobileDevice.js')}}"></script>
<!-- Nicescroll -->
<script src="{{asset('vendor/nicescroll/jquery.nicescroll.js')}}"></script>
<!-- smooth-scrollbar -->
<script src="{{asset('vendor/smooth-scrollbar/smooth-scrollbar.js')}}"></script>
<!-- Sweetalert2 -->
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
@stack('scripts')
@include('layouts.partials._scripts')
@include('layouts.partials._alert')
@include('layouts.partials._confirm')
</body>
</html>