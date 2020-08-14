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
        <title>{{__('box.testing')}} @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
        <link rel="stylesheet" type="text/css"  href="/assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="/assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css"/>
        <link rel="stylesheet" type="text/css" href="/assets/lib/jqvmap/jqvmap.min.css"/>
        <link rel="stylesheet" type="text/css" href="/assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css"/>
        <link rel="stylesheet" href="/assets/css/style.css" type="text/css"/>
        @yield('css')
    </head>
    <body>
    <div class="be-wrapper be-fixed-sidebar">
      <nav class="navbar navbar-default navbar-fixed-top be-top-header">
        <div class="container-fluid">
          <div class="navbar-header"><a href="{{route('admin.home')}}" class="navbar-brand"></a></div>
          <div class="be-right-navbar">
            <ul class="nav navbar-nav navbar-right be-user-nav">
              <li class="dropdown"><a href="javascript:" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="<?=\Auth::user()->info ? "/storage/images/".\Auth::user()->info->photo : "/assets/img/avatar.png"?>" alt="Avatar"><span class="user-name">{{\Auth::user()->name}} {{\Auth::user()->surname}}</span></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <div class="user-info">
                      <div class="user-name">{{\Auth::user()->name}} {{\Auth::user()->surname}}</div>
                      <div class="user-position online">{{__('box.online')}}</div>
                    </div>
                  </li>
                  <li>
                    <a href="{{route('frontend.profile.index',\Auth::user()->id)}}"><span class="icon mdi mdi-face"></span>Профиль</a>
                  </li>
                  <li>
                    <a href="{{route('logout')}}"><span class="icon mdi mdi-power"></span>{{__('box.logout')}}</a>
                  </li>
                </ul>
              </li>
            </ul>
            <div class="page-title"><span>{{__('box.testing')}}</span></div>
          </div>
        </div>
      </nav>
      <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper"><a href="javascript:" class="left-sidebar-toggle">{{__('box.testing')}}</a>
          <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
              <div class="left-sidebar-content">
                @include('admin.partials.sidebar')
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="be-content">
        <div class="main-content container-fluid">
            @yield('content')
        </div>
      </div>
    </div>
    <script src="/assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="/assets/js/main.js" type="text/javascript"></script>
    <script src="/assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/lib/jquery-flot/jquery.flot.js" type="text/javascript"></script>
    <script src="/assets/lib/jquery-flot/jquery.flot.pie.js" type="text/javascript"></script>
    <script src="/assets/lib/jquery-flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="/assets/lib/jquery-flot/plugins/jquery.flot.orderBars.js" type="text/javascript"></script>
    <script src="/assets/lib/jquery-flot/plugins/curvedLines.js" type="text/javascript"></script>
    <script src="/assets/lib/jquery.sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="/assets/lib/countup/countUp.min.js" type="text/javascript"></script>
    <script src="/assets/lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/assets/lib/jqvmap/jquery.vmap.min.js" type="text/javascript"></script>
    <script src="/assets/lib/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="/assets/js/app-dashboard.js" type="text/javascript"></script>
    <script src="/assets/js/select2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.dashboard();

      });
    </script>
    @yield('js')
  </body>
</html>
