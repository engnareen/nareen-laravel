@extends('layouts.front')

@section('content')


<!--Start Article-->
<div class="article" id="articles">
    <h2 class="main-title">Articles</h2>
    <div class="container">
        @foreach($articles as $article)

        <div class="box">
            <img src="{{ asset('uploads/Articles/'. $article->image_path)  }}" alt="">
            <div class="content">
                <h3>{{ $article->title }}</h3>
                <p>{{ $article->summary}}</p>
            </div>
            <div class="info">
                <a href="{{ $article->description }}">Read More</a>
                <i class="fas fa-long-arrow-alt-right"></i>
            </div>
        </div>
        @endforeach

    </div>
</div>

<!--End Article-->

<div class="spikes"></div>
<!--Start Gallary-->
<div class="gallary" id="gallary">
    <h2 class="main-title">Gallary</h2>
    <div class="container">
        @foreach($gallaries as $gallary)

        <div class="box">
            <div class="image">
                <img src="{{ asset('storage/Gallary/' .$gallary->image )}}" alt="">
            </div>
        </div>
        @endforeach
        {{-- <div class="box">
            <div class="image">
                <img src="front/images/gallary/2.jpg" alt="">
            </div>
        </div>
        <div class="box">
            <div class="image">
                <img src="front/images/gallary/3.jpg" alt="">
            </div>
        </div>
        <div class="box">
            <div class="image">
                <img src="front/images/gallary/4.jpg" alt="">
            </div>
        </div>
        <div class="box">
            <div class="image">
                <img src="front/images/gallary/5.jpg" alt="">
            </div>
        </div>
        <div class="box">
            <div class="image">
                <img src="front/images/gallary/6.jpg" alt="">
            </div>
        </div> --}}
    </div>
</div>
<!--End Gallary-->

<!-- start features -->
<div class="feature" id="feature">
    <h2 class="main main-title">Features</h2>
    <div class="container">
        @foreach ($features as $feature)
        <div class="box passion">
            <div class="image-holder">
                <img src="{{ asset('uploads/Features/' . $feature->image_path )}}" alt="">
            </div>
            <h2>{{ $feature->title }}</h2>
            <p>{{ $feature->summary }}</p>
            <a href="#">More</a>
        </div>
        @endforeach

        {{-- <div class="box time">
            <div class="image-holder">
                <img src="front/images/feature/work2.jpg" alt="">
            </div>
            <h2>Time</h2>
            <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen.</p>
            <a href="#">More</a>
        </div>

        <div class="box passion">
            <div class="image-holder">
                <img src="front/images/feature/work4.jpg" alt="">
            </div>
            <h2>Passion</h2>
            <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen.</p>
            <a href="#">More</a>
        </div> --}}

    </div>
</div>
<!-- End features -->
<div class="spikes"></div>

<!--Start Testimonials-->
<div class="testimonials" id="testimonials">
    <h2 class="main-title">Testimonials</h2>
    <div class="container">
        <div class="box">
            <img src="front/images/test/profile.png" alt="">
            <h3>Nareen Alnahhal</h3>
            <span class="title">Full Stack Developer</span>
            <div class="rate">
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen.</p>
        </div>

        <div class="box">
            <img src="front/images/test/profile.png" alt="">
            <h3>Samir Mahmoud</h3>
            <span class="title">Full Stack Developer</span>
            <div class="rate">
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen.</p>
        </div>

        <div class="box">
            <img src="front/images/test/profile.png" alt="">
            <h3>Mohamed Ahmed</h3>
            <span class="title">Full Stack Developer</span>
            <div class="rate">
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen.</p>
        </div>


        <div class="box">
            <img src="front/images/test/profile.png" alt="">
            <h3>Ali Sayed</h3>
            <span class="title">Full Stack Developer</span>
            <div class="rate">
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen.</p>
        </div>


        <div class="box">
            <img src="front/images/test/profile.png" alt="">
            <h3>Moh Ahmed</h3>
            <span class="title">Full Stack Developer</span>
            <div class="rate">
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen.</p>
        </div>


        <div class="box">
            <img src="front/images/test/profile.png" alt="">
            <h3>Malak Alnahhal</h3>
            <span class="title">Full Stack Developer</span>
            <div class="rate">
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="filled fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen.</p>
        </div>
    </div>
</div>
<!--End Testimonials-->

<!--Start Team -->
<div class="team" id="team">
    <h2 class="main-title">Team Members</h2>
    <div class="container">
        @foreach($teams as $team)
        <div class="box">
            <div class="data">
                <img src="{{ asset('storage/teamMembers/' .$team->image)}}" alt="">
                <div class="social">
                    <a href=""><i class="fab fa-facebook-f"></i></a>
                    <a href=""><i class="fab fa-twitter"></i></a>
                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                    <a href=""><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="info">
                <h3>{{$team->name}}</h3>
                <p>{{$team->job_description}}</p>
            </div>
        </div>
        @endforeach

    </div>
</div>
<!--End Team -->
<div class="spikes"></div>

<!-- Start Services -->
<div class="services" id="services">
    <h2 class="main-title">Services</h2>
    <div class="container">
        @foreach($services as $service)
        <div class="box">
            <i class="{{ $service->service_icon }} fa-4x"></i>
            <h3>{{ $service->service_name }}</h3>
            <div class="info">
                <a href="{{ route('front.service-details')}}">Details</a>
            </div>
        </div>
        @endforeach

        {{-- <div class="box">
            <i class="fas fa-tools fa-4x"></i>
            <h3>Fixcing issue</h3>
            <div class="info">
                <a href="#">Details</a>
            </div>
        </div>

        <div class="box">
            <i class="fas fa-mobile-alt fa-4x"></i>
            <h3>UI/UX Design</h3>
            <div class="info">
                <a href="#">Details</a>
            </div>
        </div>

        <div class="box">
            <i class="fas fa-laptop-code fa-4x"></i>
            <h3>Coding</h3>
            <div class="info">
                <a href="#">Details</a>
            </div>
        </div>

        <div class="box">
            <i class="fas fa-question-circle fa-4x"></i>
            <h3>Support</h3>
            <div class="info">
                <a href="#">Details</a>
            </div>
        </div>

        <div class="box">
            <i class="fas fa-bullhorn fa-4x"></i>
            <h3>Marketing</h3>
            <div class="info">
                <a href="#">Details</a>
            </div>
        </div> --}}

    </div>
</div>
<!--End Services -->

<!--Start skills-->
<div class="our-skills" id="our-skills">
    <h2 class="main-title">Our Skills</h2>
    <div class="container">
        <img src="front/images/works/skills.png" alt="">
        <div class="skills">
            @foreach($skills as $skill)
            <div class="skill">
                <h3>{{ $skill->name }}<span>{{ $skill->range }}</span></h3>
                <div class="the-progrss">
                    <span style="width: {{  $skill->range }}{{'%'}}"></span>
                </div>
            </div>
            @endforeach

            {{-- <div class="skill">
                <h3>Asp.Net<span>90%</span></h3>
                <div class="the-progrss">
                    <span style="width: 90%"></span>
                </div>
            </div>

            <div class="skill">
                <h3>PHP<span>85%</span></h3>
                <div class="the-progrss">
                    <span style="width: 85%"></span>
                </div>
            </div>

            <div class="skill">
                <h3>CSS<span>95%</span></h3>
                <div class="the-progrss">
                    <span style="width: 95%"></span>
                </div>
            </div>

            <div class="skill">
                <h3>Java Script<span>75%</span></h3>
                <div class="the-progrss">
                    <span style="width: 75%"></span>
                </div>
            </div> --}}

        </div>
    </div>
</div>
<!--End skills-->
<div class="spikes"></div>

<!--Start Work Section -->
<div class="works" id="works">
    <h2 class="main-title">How it Works?</h2>
    <div class="container">
        <img src="front/images/works/work-steps.png" alt="" class="image">

        <div class="info">
            @foreach ($works as $work)
            <div class="box">
                <img src="{{ asset('uploads/Works/'. $work->image_path) }}" alt="">
                <div class="text">
                    <h3>{{ $work->title }}</h3>
                    <p>{{ $work->summary}}</p>
                </div>
            </div>
            @endforeach
            {{-- <div class="box">
                <img src="front/images/works/work-steps-2.png" alt="">
                <div class="text">
                    <h3>Bussniess Analysis</h3>
                    <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is slechts
                        een proeftekst uit het drukkerij- en zetterijwezen</p>
                </div>
            </div>

            <div class="box">
                <img src="front/images/works/work-steps-3.png" alt="">
                <div class="text">
                    <h3>Bussniess Analysis</h3>
                    <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is slechts
                        een proeftekst uit het drukkerij- en zetterijwezen</p>
                </div>
            </div> --}}
        </div>
    </div>
</div>

<!--end Work Section -->

<!-- Start Events -->
<div class="events" id="events">
    <h2 class="main-title">Latest Events</h2>
    <div class="container">
        @foreach($events as $event)
        <img src="{{ asset('uploads/Events/' . $event->image_path) }}" alt="">
        <div class="info">
            <div class="time">
                <div class="unit">
                    <span>{{$days}}</span>
                    <span>Days</span>
                </div>

                <div class="unit">
                    {{-- <span>{{ $event->format('H') }}</span> --}}
                    <span>{{ $dhms->format('H') }}</span>
                    {{-- {{ $diff_in_hours }} --}}
                    <span>hours</span>
                </div>

                <div class="unit">
                    <span>{{ $dhms->format('i') }}</span>
                    <span>Minutes</span>
                </div>

                <div class="unit">
                    <span>{{ $dhms->format('s') }}</span>
                    <span>Seconds</span>
                </div>
            </div>
            <h2 class="title">{{ $event->title }}</h2>
            <p class="description">{{ $event->summary }}</p>

        </div>
        @endforeach

        <div class="subscribe">
            <form action="">
                <input type="email" placeholder="Enter Your Email">
                <input type="submit" value="Subscribe">
            </form>
        </div>
    </div>
</div>
<!-- End Events -->
<div class="spikes"></div>

<!--Start Pricing-->
<div class="pricing" id="pricing">
    <h2 class="main-title">Pricing Paln</h2>
    <div class="container">
        {{-- <div class="box">
            <h3 class="title">Basic</h3>
            <img src="front/images/pricing/basic.png" alt="">
            <div class="price">
                <span class="amount">$15</span>
                <span class="time">Per Month</span>
            </div>
            <ul>
                <li>10 GB HDD Space</li>
                <li>5 Email Address</li>
                <li>2 Subdomains</li>
                <li>4 databases</li>
            </ul>
            <a href="#">Chosse Plan</a>
        </div> --}}
        @foreach($plans as $plan)

        <div class="box popular">
            <div class="label">{{ $plan->is_popular == 1 ? 'Most Popular' : ''}}</div>
            <h3 class="title">{{ $plan->name }}</h3>
            <img src="{{ asset('uploads/Plans/' . $plan->image_path) }}" alt="{{ $plan->name }}">
            <div class="price">
                <span class="amount">${{ $plan->cost }}</span>
                <span class="time">{{ $plan->type }}</span>
            </div>
            <ul>
                @foreach($plan->tags as $tag)
                    <li>{{ $tag->name }}</li>
                @endforeach
            </ul>
            <a href="#">Chosse Plan</a>
        </div>
        @endforeach

        {{-- <div class="box professional">
            <h3 class="title">Professional</h3>
            <img src="front/images/pricing/advanced.webp" alt="">
            <div class="price">
                <span class="amount">$45</span>
                <span class="time">Per Month</span>
            </div>
            <ul>
                <li>100 GB HDD Space</li>
                <li>50 Email Address</li>
                <li>20 Subdomains</li>
                <li>4 databases</li>
            </ul>
            <a href="#">Chosse Plan</a>
        </div> --}}

    </div>
</div>
<!--End Pricing-->

<!--Start Videos -->
<div class="videos" id="videos">
    <h2 class="main-title">Top Videos</h2>
    <div class="container">
        <div class="holder">
            <div class="list">
                <div class="name">
                    Top Videos
                    <i class="fas fa-random"></i>
                </div>
                <ul>
                    <li>How to create sub domain<span>3:25</span></li>
                    <li>Every thing about virtual host<span>3:45</span></li>
                    <li>How to monitor your website<span>2:35</span></li>
                    <li>How to create sub domain ?<span>5:18</span></li>
                    <li>How to create sub domain ?<span>3:18</span></li>
                    <li>How to monitor your website<span>4:20</span></li>
                    <li>How to monitor your website<span>6:18</span></li>
                </ul>
            </div>
            <div class="preview">
                <img src="front/images/video/video-preview.jpg" alt="">
                <div class="info">Every thing about virtual host</div>
            </div>
        </div>
    </div>
</div>
<!--End Videos -->
<div class="spikes"></div>

<!--Start Stats-->
<div class="stats" id="stats">
    <h2>Our Awesome Stats</h2>
    <div class="container">
        <div class="box">
            <i class="far fa-user fa-2x fa-fw"></i>
            <span class="number">300</span>
            <span class="text">Clients</span>
        </div>

        <div class="box">
            <i class="fas fa-code fa-2x fa-fw"></i>
            <span class="number">400</span>
            <span class="text">Projects</span>
        </div>

        <div class="box">
            <i class="fas fa-globe-asia fa-2x fa-fw"></i>
            <span class="number">12</span>
            <span class="text">Countries</span>
        </div>


        <div class="box">
            <i class="far fa-money-bill-alt fa-2x fa-fw"></i>
            <span class="number">500K</span>
            <span class="text">Money</span>
        </div>
    </div>
</div>
<!--End Stats-->

<!--Start discounts-->
<div class="discount" id="discount">
    <div class="image">
        <div class="content">
            <h2>We have A DISCOUNT</h2>
            <p>Lorem ipsum is placeholder text commonly used
                in the graphic, print, and publishing industries for previewing layouts and visual mockups.
            </p>
            <img src="front/images/video/discount.png" alt="">
        </div>
    </div>
    <div class="form">
        <div class="content">
            <x-flash-message />
            {{-- @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $erorr)
                        <li>{{ $erorr }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            <h2>Request A Discount</h2>
            {{-- <link rel="stylesheet" href="{{ asset('bootstrap-3.1.1/css/bootstrap.min.css') }}"> --}}
                <style>
                    .alert {
                    padding: 15px;
                    margin-bottom: 20px;
                    border: 1px solid transparent;
                    border-radius: 4px;
                    }
                    .alert-success {
                    background-color: #dff0d8;
                    border-color: #d6e9c6;
                    color: #3c763d;
                    }
                    .alert-danger {
                    background-color: #f2dede;
                    border-color: #ebccd1;
                    color: #a94442;
                    }
                </style>

            <form action="{{ route('discount.store') }}" id="discount_form" enctype="multipart/form-data">
                {{-- @csrf --}}
                <input type="hidden" id="token" value="{{ @csrf_token() }}">
                <div id="res" ></div>
                <br>
                <x-form.input class="input" type="text" placeholder="Your Name" id="name" name="name" value="" />
                <x-form.input class="input" type="email" placeholder="Your Email" id="email" name="email" value=""/>
                <x-form.input class="input" type="text" placeholder="Your Mobile" id="mobile" name="mobile" value=""/>
                <x-form.textarea name="Details" class="input" id="Details"  placeholder="Tell us about your needs" value=""></x-form.textarea>
                <button type="submit" id="#btn" {{--onclick="event.preventDefault(); document.getElementById('discount_form').submit();"--}}>Send</button>

            </form>
            <script src="{{ asset('js/jquery-3.5.0.min.js') }}"></script>
            <script>
                $(document).ready(function(){
                    $('#discount_form').submit(function(e){
                        e.preventDefault();
                        let url=$(this).attr('action');
                        var form =this;
                        //alert(url);
                        $.post(url,{
                            '_token': $('#token').val(),
                            'name': $('#name').val(),
                            'email' : $('#email').val(),
                            'mobile' : $('#mobile').val(),
                            'Details' : $('#Details').val()
                        }, function(response){
                            //console.log(response);
                            if(response.code == 400){
                            $("#btn").attr('disabled', false);
                            let error = '<span class="alert alert-danger">'+response.msg+'</span>';
                            $("#res").html(error);
                        }else if(response.code == 200){
                            $(form)[0].reset();
                            $("#btn").attr('disabled', false);
                            let success = '<span class="alert alert-success">'+response.msg+'</span>';
                            $("#res").html(success);
                        }
                        });
                    })
                })





            </script>
        </div>
    </div>

</div>
<!--End discounts-->

@endsection
