<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/assets/img/logo-fav.png">
    <title>Тестирование - Создание учителя</title>
    <link rel="stylesheet" type="text/css" href="/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/assets/css/style.css" type="text/css"/>
</head>
<body class="be-splash-screen">
<div class="be-wrapper be-login be-signup">
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="splash-container sign-up">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading"><img src="/assets/img/logo-xx.png" alt="logo" width="102" height="27" class="logo-img"><span class="splash-description">Please enter your user information.</span></div>
                    <div class="panel-body">
                        @include('admin.errors')
                        <form action="{{route('admin.users.store')}}" method="POST"><span class="splash-title xs-pb-20">{{__('box.create')}}</span>
                            @csrf
                            <input type="text" name="role_id" value="2" hidden>
                            <div class="form-group">
                                <input type="text" name="login"  placeholder="{{__('box.login')}}" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="name"  placeholder="{{trans_choice('box.name',1)}}" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="surname" placeholder="Фамилия" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email"  placeholder="{{__('box.email')}}" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="tel" name="tel" id="tel" required placeholder="Телефонный номер" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group row signup-password">
                                <div class="col-xs-6">
                                    <input id="password" type="password" name="password"  placeholder="{{__('box.password')}}" class="form-control">
                                </div>
                                <div class="col-xs-6">
                                    <input type="password"  name="password_confirmation" placeholder="{{__('box.confirmPass')}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group xs-pt-10">
                                <button type="submit" class="btn btn-block btn-primary btn-xl">{{__('box.create')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="splash-footer">&copy; 2019 Your Company</div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
<script src="/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="/assets/js/main.js" type="text/javascript"></script>
<script src="/assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
<script src="/assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function(){
        //initialize the javascript

        App.init();

        $(function () {
            $("#tel").mask("(99)999-99-99");
        });


    });
</script>
</body>
</html>
