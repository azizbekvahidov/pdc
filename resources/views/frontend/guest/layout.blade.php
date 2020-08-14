<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <meta name="author" content="Firdavs Ibodullaev">
    <meta name="author" content="Ruxshona Muxamedjanova">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *Must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Progressive Development Courses @yield('title')</title>

    <!-- Favicon -->
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

    <!-- Stylesheet -->
    <link rel="stylesheet" href="/assets/guest/style.css">
    @yield('style')
</head>

<body>
<!-- Preloader -->
<div id="preloader">
    <div class="spinner"></div>
</div>
@yield('content')
<!-- ##### All Javascript Script ##### -->
<!-- jQuery-2.2.4 js -->
<script src="/assets/guest/js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="/assets/guest/js/bootstrap/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="/assets/guest/js/bootstrap/bootstrap.min.js"></script>
<!-- All Plugins js -->
<script src="/assets/guest/js/plugins/plugins.js"></script>
<!-- Active js -->
<script src="/assets/guest/js/active.js"></script>
@yield('script')
</body>

</html>
