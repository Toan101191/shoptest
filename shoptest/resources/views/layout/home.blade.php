<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Trang chủ
    </title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('asset1\css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('asset1\css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('asset1\css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('asset1\css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('asset1\css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('asset1\css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('asset1\css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('asset1\css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<style>
    ul li:hover {
        background-color: #eee;
        transform: scale(1.1);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .header__cart .user-info {
        position: relative;
    }

    /* Thêm kiểu cho vị trí của popup chứa các sản phẩm trong giỏ hàng */
    .header__cart {
        position: relative;
        z-index: 1;
    }

    .cart__popup {
        position: absolute;
        top: 100%;
        right: 0;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 10px;
        width: 300px;
        max-height: 300px;
        /* Định nghĩa chiều cao tối đa của bảng chứa sản phẩm */
        overflow-y: auto;
        /* Thêm thanh cuộn khi nội dung vượt quá chiều cao tối đa */
        display: none;
        z-index: 2;
        font-size: 12px;
    }

    .asd {
        position: relative;
        z-index: 1;
    }

    /* Hiển thị bảng chứa sản phẩm khi hover vào biểu tượng cart */
    .asd:hover .cart__popup {
        display: block;
    }

    /* Thiết lập kiểu cho bảng chứa sản phẩm */
    .cart__popup table {
        width: 100%;
        border-collapse: collapse;
    }

    .cart__popup table th,
    .cart__popup table td {
        padding: 8px;
        text-align: left;
    }

    .cart__popup table th {
        background-color: #f0f0f0;
        font-weight: bold;
    }

    .cart__popup table td img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
    }


    .featured__item__pic {
        position: relative;
    }

    .featured__item__pic .category-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #ff6b6b;
        color: #fff;
        font-size: 12px;
        font-weight: bold;
        padding: 5px 8px;
        border-radius: 3px;
    }

    .blog__item__pic {
        position: relative;
    }

    .blog__item__tag {
        position: absolute;
        font-size: 12px;
        font-weight: bold;
        padding: 3px 8px;
        border-radius: 3px;
        color: #fff;
    }

    .new-tag {
        top: 10px;
        right: 10px;
        background-color: #0d6efd;
    }

    .hot-tag {
        top: 10px;
        left: 10px;
        background-color: #dc3545;
    }

    .image-container {
        width: 130px;
        /* Đặt kích thước chiều rộng mong muốn */
        overflow: hidden;
        /* Ẩn phần dư của hình ảnh nếu vượt quá kích thước đã đặt */
    }

    .image-container img {
        width: 100%;
        /* Đảm bảo hình ảnh đầy đủ chiều rộng */
        object-fit: cover;
        /* Đảm bảo hình ảnh không bị kéo biến để đủ kích thước */
    }

    /* CSS cho danh sách dropdown */
    .dropdown-menu {
        display: none;
    }

    /* CSS cho hiển thị dropdown khi hover vào tên */
    .dropdown:hover .dropdown-menu {
        display: block;
    }

    #profile-menu {
        display: none;
    }
</style>

<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="asset1/img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <div><a href=""><i class="fa fa-user"></i></a></div>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="/"><img src="asset1/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="/">Trang chủ</a></li>
                            <li><a href="{{ route('layout.prd') }}">Sản phẩm</a>
                            </li>
                            <li>
                                <a href="#">Thương Hiệu</a>
                                <ul class="header__menu__dropdown">
                                    @foreach ($list_brand as $brand)
                                    <li><a href="./shop-details.html">{{ $brand->brandname }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="./blog.html">Tin tức</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li class="asd">
                                <a href="{{ route('layout.cart') }}"><i class="fa fa-shopping-bag"></i> <span>{{ count($cartItems) }}</span></a>
                                <div class="cart__popup" id="cartPopup">
                                    <!-- Nội dung bảng sản phẩm trong giỏ hàng -->
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Giá</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cartItems as $itemIndex => $item)
                                            <tr>
                                                <td>{{ $itemIndex + 1 }}</td>
                                                <td><img src="{{ asset('img/product/' . $item['product']->imgproduct) }}" alt="Hình ảnh sản phẩm"></td>
                                                <td>{{ $item['quantity'] }}</td>
                                                <td>{{ number_format($item['product']->price * $item['quantity']) }} VND</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            @if(session('customername'))
                            <li class="dropdown show-on-hover" id="profile-dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    {{ session('customername') }}
                                </a>
                                <ul class="dropdown-menu" id="profile-menu">
                                    <li><a href="#">Thông tin cá nhân</a></li>
                                    @if(session('role_id') == 1 || session('role_id') == 3)
                                    <li><a href="{{ route('admin.dasboard') }}">Trang quản trị</a></li>
                                    @endif
                                    <li>
                                        <div>
                                            <form action="{{ route('layout.logout') }}" method="POST">
                                                @csrf
                                                <a href="javascript:void(0)" onclick="event.preventDefault(); this.closest('form').submit();">Đăng xuất</a>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @else
                            <!-- Trường hợp chưa đăng nhập -->
                            <li><a href="{{ route('layout.login') }}"><i class="fa fa-user"></i></a></li>
                            @endif
                        </ul>
                    </div>

                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Tất cả danh mục</span>
                        </div>
                        <ul>
                            @foreach ($list_category as $category)
                            <li><a href="#">{{ $category->categoryname }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" placeholder="Tìm gì đó...?">
                                <button type="submit" class="site-btn">Tìm kiếm</button>
                            </form>
                        </div>
                    </div>
                    <div id="carouselExample" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($list_slide as $slide)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="hero__item set-bg" data-setbg="{{ asset('img/product/' . $slide->slide_image) }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Sản phẩm mới nhất</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($latestProducts->chunk(3) as $chunk)
                            <div class="latest-prdouct__slider__item">
                                @foreach ($chunk as $product)
                                <a href="{{route('layout.details',['product'=>$product->id])}}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <div class="image-container">
                                            <img src="{{ asset('img/product/' . $product->imgproduct) }}" alt="{{ $product->productname }}">
                                        </div>
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->productname }}</h6>
                                        <span>{{ $product->price }}</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Sản phẩm nổi bật</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($latestOutstandingProducts->chunk(3) as $chunk)
                            <div class="latest-prdouct__slider__item">
                                @foreach ($chunk as $product)
                                <a href="{{route('layout.details',['product'=>$product->id])}}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <div class="image-container">
                                            <img src="{{ asset('img/product/' . $product->imgproduct) }}" alt="{{ $product->productname }}">
                                        </div>
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->productname }}</h6>
                                        <span>{{ $product->price }}</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Sản phẩm ngẫu nhiên</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($randomProducts->chunk(3) as $chunk)
                            <div class="latest-prdouct__slider__item">
                                @foreach ($chunk as $product)
                                <a href="{{route('layout.details',['product'=>$product->id])}}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <div class="image-container">
                                            <img src="{{ asset('img/product/' . $product->imgproduct) }}" alt="{{ $product->productname }}">
                                        </div>
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->productname }}</h6>
                                        <span>{{ $product->price }}</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">Tất cả</li>
                            @foreach ($list_category as $category)
                            <li data-filter=".category-{{ $category->id }}">{{ $category->categoryname }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($list_product as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mix category-{{ $product->category_id }}">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('img/product/' . $product->imgproduct) }}">
                            <ul class="featured__item__pic__hover">
                                <li>
                                    <a href="#" data-product-id="{{ $product->id }}" onclick="event.preventDefault(); addToCart(this);">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('layout.details',['product'=>$product->id])}}"><i class="fa fa-eye"></i></a>

                                </li>
                            </ul>
                            <span class="category-badge">{{ $product->category->categoryname }}</span>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"><b>Tên sản phẩm</b>: {{ $product->productname }}</a></h6>
                            <h5 style="color: #dc3545;">{{ number_format($product->price, 0, ',', '.') }} VND</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="banner__pic">
                        <img src="asset1/img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="banner__pic">
                        <img src="asset1/img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="banner__pic">
                        <img src="asset1/img/banner/banner-2.jpg" alt="">

                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <section class="categories">
        <div class="container">
            <div class="section-title">
                <h2>Thương Hiệu</h2>
            </div>
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($list_brand as $brand)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg small-image" data-setbg="{{ asset('img/product/' . $brand->image) }}"></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>Tin tức của cửa hàng</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($list_new as $news)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img height="200" src="{{ asset('img/product/' . $news->image) }}" alt="{{ $news->title }}">
                            <span class="blog__item__tag new-tag">Tin mới</span>
                            @if ($news->cat_new == 2)
                            <span class="blog__item__tag hot-tag">Tin hot</span>
                            @endif
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> {{ $news->created_at }}</li>
                                <li><i class="fa fa-user"></i> {{ $news->customer->customername  }}</li>
                            </ul>
                            <h5><a href="#">{!! $news->newtitle !!}</a></h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="asset1/img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Địa chỉ:Vĩnh Khúc-Văn Giang-Hưng Yên</li>
                            <li>số điện thoại: 0356964919</li>
                            <li>Email: nhunaoker1@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Thương hiệu</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    @foreach ($list_brand->take($list_brand->count() / 2) as $brand)
                                    <li><a href="#">{{ $brand->brandname }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    @foreach ($list_brand->slice($list_brand->count() / 2) as $brand)
                                    <li><a href="#">{{ $brand->brandname }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Liên hệ với chúng tôi bây giờ</h6>
                        <p>Nhận thông tin cập nhật qua email về cửa hàng mới nhất của chúng tôi và các ưu đãi đặc biệt.</p>
                        <form action="#">
                            <input type="text" placeholder="nhập mail">
                            <button type="submit" class="site-btn">Gửi</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{asset('asset1\js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('asset1\js/bootstrap.min.js')}}"></script>
    <script src="{{asset('asset1\js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('asset1\js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('asset1\js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('asset1\js/mixitup.min.js')}}"></script>
    <script src="{{asset('asset1\js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('asset1\js/main.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function addToCart(element) {
            var productId = element.getAttribute('data-product-id');
            $.ajax({
                url: "{{ route('addToCart', ['id' => ':id']) }}".replace(':id', productId),
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Hiển thị swal thành công
                    swal({
                        title: 'Thành công',
                        text: 'Sản phẩm đã được thêm vào giỏ hàng',
                        icon: 'success',
                        timer: 2000, // Thời gian hiển thị (ms)
                        buttons: false,
                    }).then(function() {
                        // Sau khi nhấn OK, tải lại trang
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi (nếu cần)
                }
            });
        }
    </script>
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
    @if(Session::has('success'))
    <script>
        swal({
            title: "Đặt hàng thành công",
            text: "Cảm ơn bạn đã mua hàng",
            icon: "success",
            button: "OK",
        });
    </script>
    @endif
    <script>
        // Lấy tham chiếu đến phần tử cartPopup
        const cartPopup = document.getElementById('cartPopup');

        // Lấy tham chiếu đến phần tử <li class="asd">
        const asdListItem = document.querySelector('.asd');

        // Thêm sự kiện "mouseover" (hover vào) cho phần tử <li class="asd">
        asdListItem.addEventListener('mouseover', () => {
            // Hiển thị phần tử cartPopup khi hover vào phần tử <li class="asd">
            cartPopup.style.display = 'block';
        });

        // Thêm sự kiện "mouseout" (rê chuột ra ngoài) cho phần tử <li class="asd">
        asdListItem.addEventListener('mouseout', () => {
            // Ẩn phần tử cartPopup khi rê chuột ra khỏi phần tử <li class="asd">
            cartPopup.style.display = 'none';
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Lấy tham chiếu đến phần tử
        var profileDropdown = document.getElementById('profile-dropdown');
        var profileMenu = document.getElementById('profile-menu');

        // Xử lý sự kiện hover vào tên
        profileDropdown.addEventListener('mouseenter', function() {
            profileMenu.style.display = 'block';
        });

        // Xử lý sự kiện di chuột ra ngoài
        profileDropdown.addEventListener('mouseleave', function(event) {
            // Kiểm tra nếu di chuột ra ngoài phần tử dropdown hoặc phần tử menu
            if (!profileDropdown.contains(event.relatedTarget) && !profileMenu.contains(event.relatedTarget)) {
                profileMenu.style.display = 'none';
            }
        });
    </script>
</body>

</html>