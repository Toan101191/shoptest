<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giỏ hàng</title>

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
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="./index.html"><img src="{{ asset('asset1/img/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="./index.html">Trang chủ</a></li>
                        <li><a href="./shop-grid.html">Sản phẩm</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="./shop-details.html">Nam</a></li>
                                <li><a href="./shop-details.html">Nữ</a></li>
                                <li><a href="./shop-details.html">Trẻ em</a></li>
                            </ul>
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
                        <li><a href="#"><i class="fa fa-user"></i></a></li>
                        <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                    </ul>
                    <div class="header__cart__price">tổng: <span>$150.00</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
    </header>
    <section class="hero hero-normal">
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
                                <input type="text" placeholder="Tìm gì đó?">
                                <button type="submit" class="site-btn">Tìm kiếm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">ID</th>
                                    <th class="shoping__product">Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $total = 0;
                                @endphp
                                @foreach ($cartItems as $itemIndex => $item)
                                @php
                                $subtotal = $item['product']->price * $item['quantity'];
                                $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>{{$itemIndex}}</td>
                                    <td class="shoping__cart__item">
                                        <img src="{{ asset('img/cart/cart-1.jpg') }}" alt="">
                                        <h5>{{ $item['product']->productname }}</h5>
                                    </td>
                                    <td class="shoping__cart__img">
                                        <img src="{{ asset('img/product/' . $item['product']->imgproduct) }}" alt="Product Image">
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{ number_format($item['product']->price) }}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="number" class="quantity-input" value="{{ $item['quantity'] }}" min="1" data-product-id="{{ $itemIndex }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        <span class="row-total" id="row-total-{{ $itemIndex }}">
                                            {{ number_format($subtotal) }}
                                        </span>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <button class="btn btn-danger btn-remove" data-product-id="{{ $item['product']->id }}">Xoá</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="/" class="primary-btn cart-btn">Tiếp tục mua sắm</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right" id="update-cart-btn">
                            <i class="fa-solid fa-rotate-right"></i>Cập nhật giỏ hàng
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Tổng tiền giỏ hàng</h5>
                        <ul>
                            <li>Tổng phụ <span>{{ number_format($total) }}</span></li>
                            <li>( VAT ) <span>5%</span></li>
                            <li>Tiền ship <span>30.000</span></li>
                            <li>Thực tế <span>{{ number_format($total + ($total * 0.05 + 30000)) }}</span></li>
                        </ul>
                        <a href="#" class="primary-btn">Đặt hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Js Plugins -->
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
    <script>
        document.getElementById("update-cart-btn").addEventListener("click", function(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

            Swal.fire({
                icon: 'info',
                title: 'Đang cập nhật lại...',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didClose: function() {
                    location.reload(); // Reload lại trang
                }
            });
        });
    </script>
    <script>
        // Xoá sản phẩm khỏi giỏ hàng
        $('.btn-remove').click(function() {
            var productId = $(this).data('product-id');

            // Hiển thị cửa sổ xác nhận
            Swal.fire({
                icon: 'question',
                title: 'Xác nhận xoá?',
                text: 'Bạn có chắc muốn xoá sản phẩm này khỏi giỏ hàng?',
                showCancelButton: true,
                confirmButtonText: 'Xoá',
                cancelButtonText: 'Hủy',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false,
                reverseButtons: true
            }).then(function(result) {
                // Nếu xác nhận xoá
                if (result.isConfirmed) {
                    removeFromCart(productId);
                }
            });
        });

        function removeFromCart(productId) {
            var url = "{{ route('cart.removeItem', ['productId' => ':productId']) }}";
            url = url.replace(':productId', productId);

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "POST"
                },
                success: function(response) {
                    // Xoá thành công, cập nhật lại giao diện
                    // Hiển thị Swal thông báo thành công

                    Swal.fire({
                        icon: 'success',
                        title: 'Xoá thành công!',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        didClose: function() {
                            // Tải lại trang
                            location.reload();
                        }
                    });
                },
                error: function(error) {
                    // Xử lý lỗi (nếu có)
                }
            });
        }
    </script>

</body>

</html>