@extends('frontend.guest.layout')
@section('title', "Старт")
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
                    <a class="nav-brand" href="/"><img src="/assets/img/logo2.png" alt="logo" width="280"></a>

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
            <div class="row">
                <div class="col-12">
                    <div class="page-content">
                        Начинаем тест!
                        <form action="{{route('frontend.test.clickStart')}}" method="post">
                            @csrf
                            <input type="text" name="id" value="{{$id}}" hidden>
                            <input type="text" name="group" value="{{$group_id}}" hidden>
                            <label for="start"><h3><strong>Начинать!</strong></h3></label>
                            <input type="submit" id="start" name="start" value="start" hidden>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Regular Page Area End ##### -->
    @include('frontend.guest.partials.footer')
@endsection
@section('style')
    <style>
        label{
            cursor: pointer;
        }
        label:hover{
            color: #ccc;
        }
        label:active{
            color: #999;
        }
    </style>
@endsection
