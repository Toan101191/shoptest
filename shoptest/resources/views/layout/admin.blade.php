@section('name','Trang quản trị')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang quản trị</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description">
    <meta content="Coderthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets\images\admin.jpg')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-XXXXXX" crossorigin="anonymous">
    <!-- App css -->
    <link href="{{asset('assets\css\bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet">
    <link href="{{asset('assets\css\icons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets\css\app.min.css')}}" rel="stylesheet" type="text/css" id="app-stylesheet">

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">


        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('img/product/' . session('image')) }}" alt="user-image" class="rounded-circle">
                        <span class="d-none d-sm-inline-block ml-1 font-weight-medium">{{ session('customername') }}</span>
                        <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow text-white m-0">Welcome !</h6>
                        </div>
                        <div>
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-outline"></i>
                                <span>Profile</span>
                            </a>
                        </div>
                        <div class="dropdown-divider"></div>

                        <div>
                            <form id="logout-form" action="{{ route('layout.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="javascript:void(0);" class="dropdown-item notify-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-logout-variant"></i>
                                <span>Logout</span>
                            </a>
                        </div>

                    </div>
                </li>
            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{route('admin.dasboard')}}" class="logo text-center">
                    <img height="120" src="{{asset('img\product\logo.jpg')}}" alt="" height="22">
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect waves-light">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>

                <li class="d-none d-sm-block">
                    <form class="app-search">
                        <div class="app-search-box">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tìm kiếm...">
                                <div class="input-group-append">
                                    <button class="btn" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </li>

            </ul>
        </div>
        <!-- end Topbar -->


        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="slimscroll-menu">

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul class="metismenu" id="side-menu">
                        <li>
                            <a href="{{route('product.index')}}">
                                <i class="pe-7s-album"></i>.
                                <span> Sản phẩm </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('category.index')}}">
                                <i class="pe-7s-smile"></i>.
                                <span> Danh mục sản phẩm </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('brand.index')}}">
                                <i class="pe-7s-rocket"></i>.
                                <span> Thương hiệu </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('customer.index')}}">
                                <i class="pe-7s-rocket"></i>.
                                <span> Người dùng </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('brand.index')}}">
                                <i class="pe-7s-rocket"></i>.
                                <span> Hoá đơn </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('brand.index')}}">
                                <i class="pe-7s-rocket"></i>.
                                <span> TIN TỨC </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('brand.index')}}">
                                <i class="pe-7s-rocket"></i>.
                                <span> Đơn hàng </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('slide.index')}}">
                                <i class="pe-7s-rocket"></i>.
                                <span> Slide </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('role.index')}}">
                                <i class="pe-7s-rocket"></i>.
                                <span> Quyền </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-content-copy"></i>
                                <span> Extra Pages </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="pages-timeline.html">Timeline</a></li>
                                <li><a href="pages-invoice.html">Invoice</a></li>
                                <li><a href="pages-pricing.html">Pricing</a></li>
                                <li><a href="pages-gallery.html">Gallery</a></li>
                                <li><a href="pages-maintenance.html">Maintenance</a></li>
                                <li><a href="pages-comingsoon.html">Coming Soon</a></li>
                            </ul>
                        </li>

                    </ul>

                </div>

            </div>
        </div>

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">@yield('name')</h4>
                            </div>
                        </div>
                    </div>

                </div> <!-- end container-fluid -->

            </div> <!-- end content -->
            @yield('content')

        </div>

    </div>

    <!-- Vendor js -->
    <script src="{{asset('assets\js\vendor.min.js')}}"></script>

    <!--Morris Chart-->
    <script src="{{asset('assets\libs\morris-js\morris.min.js')}}"></script>
    <script src="{{asset('assets\libs\raphael\raphael.min.js')}}"></script>
    <!-- Dashboard init js-->
    <script src="{{asset('assets\js\pages\dashboard.init.js')}}"></script>
    <script src="{{asset('public\ckeditor5-38.1.0-d9g3zxgkhin8.zip\build/ckeditor.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('assets\js\app.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor.create(document.querySelector('.ckeditor'));
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if(Session::has('successMsg'))
    <script>
        swal("Thông báo", "{{Session::get('successMsg')}}", "success");
    </script>
    @endif

    @if(Session::has('errorMsg'))
    <script>
        swal("Thất bại", "{{Session::get('errorMsg')}}", "warning");
    </script>
    @endif
</body>

</html>