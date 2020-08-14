<?$i=0;?>
@extends('frontend.guest.layout')
@section('title', " — Тест")
@section('content')

    <!-- ##### Header Area Start ##### -->
    <header class="header-area"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <!-- Navbar Area -->
        <div class="clever-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="cleverNav">

                    <!-- Logo -->
                    <a class="nav-brand" href="#"><img src="/assets/img/logo2.png" alt="logo" width="280"></a>

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
                        <h2>{{\Auth::user()->name}}</h2>
                        <hr>
                        <div>
                            <h3>Вы прошли тест</h3>
                            <strong><span class="text-primary">Правильно решено:&nbsp;&nbsp;</span></strong>
                            @if($test_action->true_answers) <span class="text-success">{{round($test_action->true_answers)}}%</span>
                            @else <span class="text-danger">Нет правильных решений</span>
                            @endif

                        </div>
                        <div style="clear: both">
                            <br><br>
                            <a href="{{route('frontend.test.finish')}}"><h4 class="text-success">На главную страницу</h4></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Regular Page Area End ##### -->
    @include('frontend.guest.partials.footer')
@endsection
