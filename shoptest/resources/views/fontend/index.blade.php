<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>web thời trang</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('asset1/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset1/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset1/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset1/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset1/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset1/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset1/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset1/css/style.css') }}" type="text/css">
</head>

<body>
    @include('fontend.header')
    @yield('content')
    @include('fontend.footer')
    <script src="{{ asset('asset1/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('asset1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset1/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('asset1/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('asset1/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('asset1/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('asset1/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset1/js/main.js') }}"></script>
    <!-- Thêm mã JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


</body>

</html>