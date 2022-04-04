<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.name', 'Nareen') }}</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="{{ asset('front/images/favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('front/images/favicon.ico') }}" type="image/x-icon">

        <link rel="stylesheet" href="{{ asset('front/css/narin.css') }}">
        <link rel="stylesheet" href="{{ asset('front/css/all.min.css') }}">
    </head>

<body>
    <!--Start header-->
    <div class="header">
        <div class="container">
            <a href="{{ route('front.index') }}" class="logo">
                N<i style="font-size:25px" class="fas fa-heartbeat"></i>REEN</a>
            <ul class="main-nav">
                {{-- <li><a href="#articles">Article</a></li> --}}
                <li><a href="#articles">Article</a></li>

                <li><a href="#gallary">Gallary</a></li>
                <li><a href="#feature">Feature</a></li>
                <li><a href="#team">Team</a></li>
                <li><a href="#events">Events</a></li>


            </ul>
        </div>
    </div>
    <!--End header-->

    <!--Start Landing-->
    <div class="landing">
        <div class="container">
            <div class="text">
                <h2>
                    Welcome to Narin World!
                </h2>
                <p>
                    Here I share every thing about my works with the world, including some information about myself.
                </p>
            </div>
            <div class="image">
                <img src="front/images/landing-image1.png" alt="">
            </div>
        </div>
        <a href="#articles" class="go-down">
            <i class="fas fa-angle-double-down fa-2x"></i>
        </a>


    </div>
    <!--End Landing-->

    <!-- Content here -->
    @yield('content')

    <!-- Start Footer -->
    <div class="footer">
        <div class="container">
            <div class="box">
                <h3>N<i style="font-size:24px" class="fas fa-heartbeat"></i>REEN</h3>
                <ul class="social">
                    <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a class="youtube" href="#"><i class="fab fa-youtube"></i></a></li>

                </ul>
                <p class="text">Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen</p>
            </div>
            <div class="box">
                <ul class="links">
                    <li><a href="#services">SERVICES</a></li>
                    <li><a href="#team">OUR TEAM</a></li>
                    <li><a href="#events">LATEST EVENT</a></li>
                    <li><a href="#articles">ARTICLES</a></li>
                    <li><a href="#">ADD TESTIMONIALS</a></li>
                </ul>
            </div>
            <div class="box">
                <div class="line">
                    <i class="fas fa-map-marker-alt fa-fw"></i>
                    <div class="info">Palestine, Gaza Hamza Mosque</div>
                </div>

                <div class="line">
                    <i class="far fa-clock fa-fw"></i>
                    <div class="info">Bussniess Hours: 8:00 AM - 17:00 PM</div>
                </div>

                <div class="line">
                    <i class="fas fa-phone-volume fa-fw"></i>
                    <div class="info">
                        <span>+972597703112</span>
                        <span>+972597703112</span>
                    </div>
                </div>

            </div>

            @include('front.gallery')

            {{-- <div class="box footer-gallary">
                <img src="front/images/gallary/1.jpg" alt="">
                <img src="front/images/gallary/2.jpg" alt="">
                <img src="front/images/gallary/3.jpg" alt="">
                <img src="front/images/gallary/4.jpg" alt="">
                <img src="front/images/gallary/5.jpg" alt="">
                <img src="front/images/gallary/6.jpg" alt="">
            </div> --}}
        </div>

        <p class="copyright">Made with love by N<i style="font-size:14px" class="fas fa-heartbeat"></i>REEN</p>
    </div>
    <!-- End Footer -->



    </body>


</html>
