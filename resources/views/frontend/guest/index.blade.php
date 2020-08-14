@extends('frontend.guest.layout')
@section('title', ' — Главная страница')
@section('content')

    <!-- ##### Header Area Start ##### -->
    <header class="header-area"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <h1><a href="{{route('frontend.themes.index')}}">Перейти на онлайн курсы</a></h1>
        <!-- Top Header Area -->
        <div class="top-header-area d-flex justify-content-between align-items-center">
            <!-- Contact Info -->
            <div class="contact-info">
                <a href="#"><span class="fa fa-phone"></span> +998-93 519-31-71</a>
                <a href=""><span class="fa fa-envelope"></span> mostbyte.uz</a>
            </div>
            <!-- Follow Us -->
            <div class="follow-us">
                <span>Follow us</span>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="clever-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="cleverNav">

                    <!-- Logo -->
                    <a class="nav-brand" href="/"><img src="/assets/img/logo2.png" width="280" alt="logo"></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>
                        <div class="classynav">

                        @include('frontend.guest.partials.header')

                            <!-- Nav Start -->
                            @if(\Auth::user())
                        <!-- Register / Login -->
                            <div class="login-state d-flex align-items-center">
                                <div class="user-name mr-30">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="userName" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userName">
                                            <a class="dropdown-item" href="{{route('frontend.profile.index')}}">Профиль</a>
                                            <a class="dropdown-item" href="{{route('logout')}}">Выйти</a>
                                        </div>
                                        @if(session('status'))
                                            <div class="alert alert-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="userthumb">
                                    @if(\Auth::user()->info)
                                        <img src="/storage/images/{{\Auth::user()->info->photo}}" alt="">
                                    @else
                                        <img src="/assets/img/avatar.png" alt="avatar">
                                    @endif
                                </div>
                            </div>
                    @else
                                <!-- Register / Login -->
                            <div class="register-login-area">
                                <a  href="/login" class="btn">Авторизация</a>
                                <a  href="/register" class="btn">Регистрация</a>
                            </div>

                            @endif
                        </div>
                    <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Hero Area Start ##### -->
    <section id="main" class="register-now hero-area bg-img bg-overlay-2by5" style="background-image: url(/assets/guest/img/bg-img/bg1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Hero Content -->
                    <div class="hero-content text-center">
                        <h2>Progressive Development Courses</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Hero Area End ##### -->
    <section  class="register-now" >
        @if(!\Auth::user())
        <div class="register-inner-block">
            <!-- Register Now Countdown -->
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">

                    @foreach($courses as $course)

                        <div class="carousel-item">
                            <div class="register-now-countdown  wow fadeInUp" data-wow-delay="500ms">
                                <h3>Успей зарегистрироваться на курс <strong>{{$course->name}}</strong></h3>
                                <p>{{$course->description}}</p>
                                <!-- Register Countdown -->
                                <div class="register-countdown">
                                    <div class="events-cd d-flex flex-wrap" data-countdown="{{$course->countdown_time}}"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!--
            <div class="register-now-countdown col-4 col-lg-4" style="width: 50%">
                <h3>Register Now</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi fermentum laoreet elit, sit amet tincidunt mauris ultrices vitae. Donec bibendum tortor sed mi faucibus vehicula. Sed erat lorem</p>
                <!-- Register Countdown -->
                <!--<div class="register-countdown">
                    <div class="events-cd d-flex flex-wrap" data-countdown="2019/03/01"></div>
                </div>
            </div>-->
            <!--<div class="col-6 col-lg-6" style="margin-top: 10px; margin-left: 670px">-->
                <div class="register-contact-form mb-100 wow fadeInUp" data-wow-delay="250ms" >
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="contact-form">
                                    <h4>Подать заявку</h4>
                                    <form action="{{route('register')}}" method="post" autocomplete="off">
                                    	@csrf
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Имя">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="surname" id="surname" placeholder="Фамилия">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Почта">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="tel" id="tel" placeholder="Номер телефона">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn clever-btn w-100">Отправить</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--</div>-->
        </div>

@endif
    </section>
    <!-- ##### Popular Courses Start ##### -->
    <section id="courses" class="popular-courses-area section-padding-100-0" style="background-image: url(img/core-img/texture.png); ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Курсы</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Popular Course -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="250ms">
                        <img src="/assets/guest/img/bg-img/inf.jpg" alt="" >
                        <!-- Course Content -->
                        <div class="course-content">
                            <h4>Основы информатики</h4>
                            <div class="meta d-flex align-items-center">
                                <a href="#">Sarah Parker</a>
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                <a href="#">Art &amp; Design</a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim nulla, mollis eu metus in, sagittis</p>
                        </div>
                    </div>
                </div>

                <!-- Single Popular Course -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="500ms">
                        <img src="/assets/guest/img/bg-img/web.jpg" alt="">
                        <!-- Course Content -->
                        <div class="course-content">
                            <h4>Web программирование</h4>
                            <div class="meta d-flex align-items-center">
                                <a href="#">Sarah Parker</a>
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                <a href="#">Art &amp; Design</a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim nulla, mollis eu metus in, sagittis</p>
                        </div>
                    </div>
                </div>

                <!-- Single Popular Course -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="750ms">
                        <img src="/assets/guest/img/bg-img/windows.jpeg">
                        <!-- Course Content -->
                        <div class="course-content">
                            <h4>Windows программирование</h4>
                            <div class="meta d-flex align-items-center">

                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>

                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim nulla, mollis eu metus in, sagittis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Best Tutors Start ##### -->
    <section class="best-tutors-area section-padding-100" id="tutors">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Преподаватели</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="tutors-slide owl-carousel wow fadeInUp" data-wow-delay="250ms">
                    @foreach($teachers as $teacher)
                        <!-- Single Tutors Slide -->
                            <div class="single-tutors-slides">
                                <!-- Tutor Thumbnail -->
                                <div class="tutor-thumbnail">
                                    @if($teacher->info)
                                        <img src="/storage/images/{{$teacher->info->photo}}" size="100">
                                    @else
                                        <img src="/assets/img/avatar1.png" size="100">
                                    @endif
                                </div>
                                <!-- Tutor Information -->
                                <div class="tutor-information text-center">
                                    <h5>{{$teacher->name}} {{$teacher->surname}} </h5>
                                    <span>Teacher</span>
                                    <p><?=$teacher->info ? $teacher->info->info : "";?></p>
                                    <div class="social-info">
                                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
    </section>
    <!-- ##### Best Tutors End ##### -->
    <!-- ##### Upcoming Events Start ##### -->
    <section class="upcoming-events section-padding-100-0" id="news">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Новости</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Upcoming Events -->
                @foreach($news as $item)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="single-upcoming-events mb-50 wow fadeInUp" data-wow-delay="250ms">
                            <!-- Events Thumb -->
                            <div class="events-thumb">
                                <img src="/{{$item->photo}}" alt="{{$item->photo}}" >
                                <h6 class="event-date">{{$item->created_at->format('d-m-Y')}}</h6>
                                <h4 class="event-title">{{$item->title}}</h4>
                            </div>
                            <!-- Date & Fee -->
                            <div class="date-fee d-flex justify-content-between" style="height: 50mm">
                                <div class="date">
                                <p style="font-size: larger; line-height: normal; color: black; text-align: justify; margin-top: 10%">{{$item->summary}}</p>
                                </div>
                            </div>
                            <div class="blog-content" >
                                    <p class="text-center"><a href="{{route("news",$item->slug)}}">Подробнее</a><i class="fa fa-clock"></i></p>
                            </div>




                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <div class="text-center">

                    {{$news->links()}}
                </div>
            </div>
    </section>
    <!-- ##### Upcoming Events End ##### -->

    <!-- ##### Blog Area Start ##### -->
    <section class="blog-area section-padding-100-0" id="process">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Учебный процесс</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Blog Area -->
                <div class="col-12 col-md-6">
                    <div class="single-blog-area mb-100 wow fadeInUp" data-wow-delay="250ms">
                        <img src="/assets/guest/img/blog-img/1.jpg" alt="">
                        <!-- Blog Content -->
                        <div class="blog-content">
                            <a href="#" class="blog-headline">
                                <h4></h4>
                            </a>
                            <div class="meta d-flex align-items-center">
                                <a href="#">Sarah Parker</a>
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                <a href="#">Art &amp; Design</a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim nulla, mollis eu metus in, sagittis</p>
                        </div>
                    </div>
                </div>

                <!-- Single Blog Area -->
                <div class="col-12 col-md-6">
                    <div class="single-blog-area mb-100 wow fadeInUp" data-wow-delay="500ms">
                        <img src="/assets/guest/img/blog-img/2.jpg" alt="">
                        <!-- Blog Content -->
                        <div class="blog-content">
                            <a href="#" class="blog-headline">
                                <h4> </h4>
                            </a>
                            <div class="meta d-flex align-items-center">
                                <a href="#">Sarah Parker</a>
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                <a href="#">Art &amp; Design</a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim nulla, mollis eu metus in, sagittis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Blog Area End ##### -->
    @include('frontend.guest.partials.footer')
@endsection
@section('script')
    <script src="/assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $(function () {
                $("#tel").mask("(99)999-99-99");
            });

			$('.carousel-item:first-child').addClass('active');

            $("#menu").on("click","a", function (event) {

                if($(this).attr('href')[0] == '#') {
                    event.preventDefault();
                    var id  = $(this).attr('href'),
                        top = $(id).offset().top;
                    $('body,html').animate({scrollTop: top}, 500);
                }
            });
        });
    </script>
@endsection
@section('style')
    <style>
        .register-now .register-now-countdown {
            margin-left: 100px;
            -webkit-box-flex: 0;
            -ms-flex: 0 0 45%;
            flex: 0 0 45%;
            min-width: 45%;
            width: 70%;
        }
    </style>
@endsection
