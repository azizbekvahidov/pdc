<?$true = $request == null;?>
@extends('frontend.guest.layout')
@section('content')
    <div class="container">
        <section class="main">
                    @include('admin.errors')
                    <form action="{{route('registerPost')}}" method="POST">
                        <span class="splash-title xs-pb-20"><h3><strong>Регистрация</strong></h3></span>
                        @csrf
                        <input type="text" name="role_id" value="0" hidden>
                        <div class="form-group">
                            <input type="text" name="login" placeholder="Логин" autocomplete="off" class="form-control" value="{{old('login')}}">
                        </div>
                        <div class="form-group">
                            @if($true)
                                <input type="text" name="name" placeholder="Имя" autocomplete="off" class="form-control" value="{{old('name')}}">
                            @else
                                <input type="text" name="name" placeholder="Имя" autocomplete="off" class="form-control" value="{{$request['name']}}">
                            @endif
                        </div>
                        <div class="form-group">
                            @if($true)
                                <input type="text" name="surname" placeholder="Фамилия" autocomplete="off" class="form-control" value="{{old('surname')}}">
                            @else
                                <input type="text" name="surname" placeholder="Фамилия" autocomplete="off" class="form-control" value="{{$request['surname']}}">
                            @endif
                        </div>
                        <div class="form-group">
                            @if($true)
                                <input type="email" name="email" placeholder="E-mail адрес" autocomplete="off" class="form-control" value="{{old('email')}}">
                            @else
                                <input type="email" name="email" placeholder="E-mail адрес" autocomplete="off" class="form-control" value="{{$request['email']}}">
                            @endif
                        </div>
                        <div class="form-group">
                            @if($true)
                                <input type="tel" name="tel" id="tel" placeholder="Телефонный номер" autocomplete="off" class="form-control" value="{{old('tel')}}">
                            @else
                                <input type="tel" name="tel" id="tel" placeholder="Телефонный номер" autocomplete="off" class="form-control" value="{{$request['tel']}}">
                            @endif
                        </div>
                        <div class="form-group row signup-password">
                            <div class="col-xs-6">
                                <input id="password" type="password" name="password" placeholder="Пароль" class="form-control">
                            </div>
                            <div class="col-xs-6">
                                <input type="password" name="password_confirmation" placeholder="Подтверждение" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Выберите курс</label>
                            <select class="js-example-basic-multiple form-control" name="courses[]" multiple="multiple">
                            @foreach($courses as $course)
                                    <option value="{{$course->id}}">{{$course->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group xs-pt-10">
                            <button type="submit" class="btn btn-block btn-primary btn-xl">Зарегистрироваться</button>
                        </div>
                        {{--                            <div class="form-group xs-pt-10">--}}
                        {{--                                <div class="be-checkbox">--}}
                        {{--                                    <input type="checkbox" id="remember">--}}
                        {{--                                    <label for="remember">Я принимаю <a href="#">условия пользовательского соглашения</a>.</label>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                    </form>
        </section>
    </div>
    @include('frontend.guest.partials.footer')
@endsection
@section('style')
    <link rel="stylesheet" href="/assets/css/select2.min.css" type="text/css"/>
    <style>
        body{
            background-image: url("login-wallpaper.jpg");
            /*background-attachment: fixed;*/
            background-size: cover;
        }
        .main{
            width: 70%;
            background-color: #fff;
            border-radius: 15px;
            margin: 110px auto;
            padding: 6% 30px;
        }
    </style>
@endsection
@section('script')
    <script src="/assets/js/select2.min.js" type="text/javascript"></script>
    <script src="/assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            //initialize the javascript

            $('.js-example-basic-multiple').select2();

            $("#tel").mask("(99)999-99-99");
        });
    </script>
@endsection
