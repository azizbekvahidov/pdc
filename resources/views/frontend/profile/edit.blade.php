@extends('frontend.guest.layout')
@section('title', " — Пользователь ".\Auth::user()->name." ".\Auth::user()->surname)
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
                        <div class="text-center"><h3>Профиль: {{\Auth::user()->name}} {{\Auth::user()->surname}}</h3></div>
                        <br><br>
                        <h4>Изменение данных</h4>
                        <div class="row">
                            <div class="col-12">
                                @include('admin.errors')
                                <form action="{{route('frontend.profile.update')}}" method="post" autocomplete="off" class="mb-5">
                                    @csrf
                                    <input type="text" name="data" value="1" hidden>
                                    <input type="text" name="passwordData" value="0" hidden>
                                    <div class="row">
                                        <div class="col">
                                            <label for="name">Имя</label>
                                            <input type="text" name="name" placeholder="Введите имя" class="form-control" value="{{\Auth::user()->name}}">
                                        </div>
                                        <div class="col">
                                            <label for="surname">Фамилия</label>
                                            <input type="text" name="surname" placeholder="Введите фамилию" class="form-control" value="{{\Auth::user()->surname}}">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col">
                                            <label for="tel">Телефон номер</label>
                                            <input type="text" id="tel" name="tel" class="form-control" placeholder="Введит телефон номер" value="{{\Auth::user()->tel}}">
                                        </div>
                                    </div>
                                    <br><br>
                                    <button class="form-control btn btn-primary" type="submit">Сохранить</button>
                                </form>
{{--                                <br>--}}
{{--                                <h4 class="mb-3">Изменить пароль</h4>--}}
{{--                                <form action="{{route('frontend.profile.update')}}" method="post" autocomplete="off">--}}
{{--                                    @csrf--}}
{{--                                    <input type="text" name="data" value="0" hidden>--}}
{{--                                    <input type="text" name="passwordData" value="1" hidden>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="oldPass">Введите старый пароль</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Введите старый пароль" name="oldPass">--}}
{{--                                    </div>--}}
{{--                                    <br>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col">--}}
{{--                                            <label for="password">Введите новый пароль</label>--}}
{{--                                            <input type="text" name="password" placeholder="Введите новый пароль" class="form-control">--}}
{{--                                        </div>--}}
{{--                                        <div class="col">--}}
{{--                                            <label for="password">Подтвердите новый пароль</label>--}}
{{--                                            <input type="text" name="password_confirmation" placeholder="Подтвердите новый пароль" class="form-control">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <br><br>--}}
{{--                                    <button class="form-control btn btn-primary" type="submit">Сохранить</button>--}}
{{--                                </form>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Regular Page Area End ##### -->
    @include('frontend.guest.partials.footer')
@endsection
@section('script')
    <script src="/assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $(function () {
                $("#tel").mask("(99)999-99-99");
            });
        });
    </script>
@endsection
