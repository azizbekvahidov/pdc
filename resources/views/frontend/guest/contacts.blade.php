@extends('frontend.guest.layout')
@section('title', ' — Контакты')
@section('content')

    <!-- ##### Header Area Start ##### -->
    <header class="header-area"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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

    <!-- ##### Google Maps ##### -->
    <div class="map-area">
        <div id="googleMap">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3051.5474149884926!2d65.37195951524778!3d40.107802579402325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f51c7c6a7002fff%3A0x5cca7e79600d1b92!2sProgressive%20Development%20Courses!5e0!3m2!1sru!2s!4v1584120788934!5m2!1sru!2s"
                width="100%"
                height="450"
                frameborder="0"
                style="border:0;"
                allowfullscreen="">
            </iframe>
        </div>
    </div>

    <!-- ##### Contact Area Start ##### -->
    <section class="contact-area">
        <div class="container">
            <div class="row">
                <!-- Contact Info -->
                <div class="col-12 col-lg-6">
                    <div class="contact--info mt-50 mb-100">
                        <h4>Контактные данные</h4>
                        <ul class="contact-list">
                            <li>
                                <h6><i class="fa fa-clock-o" aria-hidden="true"></i>График работы</h6>
                                <h6>9:00 AM - 18:00 PM</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-phone" aria-hidden="true"></i>Номер</h6>
                                <h6>+998-93 519-31-71</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-envelope" aria-hidden="true"></i>Почта</h6>
                                <h6>info@mostbyte.uz</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-map-pin" aria-hidden="true"></i> Адрес </h6>
                                <h6>Навоийская  обл., г. Навои</h6>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-12 col-lg-6">
                    <div class="contact-form">
                        <h4>Свяжитесь с нами</h4>

                        <form action="" method="" autocomplete="off">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="text" name="name" placeholder="Имя">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="mail" placeholder="Эл.почта">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Сообщение"></textarea>
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
    </section>
    <!-- ##### Contact Area End ##### -->
    @include('frontend.guest.partials.footer')
@endsection
@section('style')

@endsection
@section('script')
@endsection
