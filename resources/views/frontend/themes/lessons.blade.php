@extends('frontend.guest.layout')
@section('title', " — Онлайн курсы PDC")
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
                            <ul id="menu">
                                <li><a href="">Посмотреть результаты</a></li>
                            </ul>

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
                            @endif
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Regular Page Area Start ##### -->
    <div class="regular-page-area section-padding-100">
        <div class="container">
            <ul class="list-unstyled">
                <?php
                $i=0;
                $last = count($themes);
                ?>
                @foreach($themes as $theme)
                    @if($i === 0)
                        <li class="media">
                            <img src="/assets/img/140x140.png" class="mr-3" alt="Скрин видеоурока">
                            <div class="media-body">
                                <a href="{{route('frontend.themes.view',$theme->id)}}"><h5 class="mt-0 mb-1">{{$theme->name}}</h5></a>
                                {{$theme->description}}
                            </div>
                        </li>
                    @endif
                    @if($i > 0 && $i < $last-1)
                        <li class="media my-4">
                            <img src="/assets/img/140x140.png" class="mr-3" alt="Скрин видеоурока">
                            <div class="media-body">
                                <a href="{{route('frontend.themes.view',$theme->id)}}"><h5 class="mt-0 mb-1">{{$theme->name}}</h5></a>
                                {{$theme->description}}
                            </div>
                        </li>
                    @endif
                    @if($i === $last-1)
                        <li class="media">
                            <img src="/assets/img/140x140.png" class="mr-3" alt="Скрин видеоурока">
                            <div class="media-body">
                                <a href="{{route('frontend.themes.view',$theme->id)}}"><h5 class="mt-0 mb-1">{{$theme->name}}</h5></a>
                                {{$theme->description}}
                            </div>
                        </li>
                    @endif
                    <?$i++;?>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- ##### Regular Page Area End ##### -->

    @include('frontend.guest.partials.footer')
@endsection
@section("style")
@endsection
