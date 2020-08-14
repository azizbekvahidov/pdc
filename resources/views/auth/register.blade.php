<?$true = $request == null;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/assets/images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon/favicon-16x16.png">
    <meta name="author" content="Firdavs Ibodullaev">
    <meta name="author" content="Ruxshona Muxamedjanova">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <link rel="shortcut icon" href="/assets/img/logo2.png">
    <title>Регистрация</title>
    <link rel="stylesheet" type="text/css" href="/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/assets/css/style.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/select2.min.css" type="text/css"/>
</head>
<body class="be-splash-screen">

<div class="be-wrapper be-login be-signup">
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="splash-container sign-up">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading"><img src="/assets/img/logo2.png" alt="logo" width="300" class="logo-img"><span class="splash-description">Введите свои пользовательские данные</span></div>
                    <div class="panel-body">
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
                    </div>
                </div>
                <div class="splash-footer">&copy; 2020 PDC</div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
<script src="/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="/assets/js/main.js" type="text/javascript"></script>
<script src="/assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/js/select2.min.js" type="text/javascript"></script>
<script src="/assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function(){
        //initialize the javascript

        App.init();

        $(function () {
            $("#tel").mask("(99)999-99-99");
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    });
</script>
</body>
</html>
