@extends('frontend.guest.layout')
@section('content')
    <div class="wrapper">
        <div class="container">
        <section class="main">
            <div class="row">
                <div class="col-md-5">
                    <div class="logo">
                        <a class="nav-brand" href="{{route('index')}}"><img src="/assets/img/logo2.png" width="280" alt="logo"></a>
                    </div>
                    <div class="paragraph">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    </div>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6 form">
                    @include('admin.errors')
                    <form action="{{route('login')}}" method="POST">
                        @csrf
                        <div class="login-form">
                            <div class="form-group">
                                <input id="login" name="login" type="text" placeholder="Логин" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <input id="password" name="password" type="password" placeholder="Пароль" class="form-control">
                            </div>
                            <div class="form-group row login-tools remember">
                                <div class="login-remember">
                                    <div class="be-checkbox">
                                        <input type="checkbox" name="remember" value="remember" id="remember">
                                        <label for="remember">Запомнить меня</label>
                                    </div>
                                </div>
{{--                                <div class="login-forgot-password"><a href="#">Забыли пароль?</a></div>--}}
                            </div>
                            <div class="form-group login-submit">
                                <div class="mb-3">
                                    <button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">Войти</button>
                                </div>
                                Если не зарегистрированы, <a href="{{route('register')}}">Зарегистроваться</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </section>
    </div>
        @include('frontend.guest.partials.footer')
    </div>
@endsection
@section('style')
    <style>
        html,
        body{
            background-image: url("login-wallpaper.jpg");
            background-size: contain;
            height: 100%;
        }
        .wrapper{
            position: relative;
            min-height: 100%;
            padding-top: 121px;
        }
        .main{
            width: 70%;
            background-color: #fff;
            border-radius: 15px;
            margin: 0 auto;
            padding: 6% 30px;
        }
        .remember{
            margin-left: 0;
        }
        .paragraph{
            margin-bottom: 20px;
        }
        .form{
            margin: auto 0;
        }
        footer{
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
@endsection
@section('script')
    <script>
        if(window.screen.width < 768){
            $('.paragraph').css('display','none');
        }
    </script>
@endsection
