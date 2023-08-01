@extends('fontend.index')
@section('content')
<style>
    /* Optional: Customize the appearance of the carousel dots and arrows */
    .owl-theme .owl-dots .owl-dot {
        display: inline-block;
    }

    .owl-theme .owl-dots .owl-dot span {
        border-radius: 50%;
        display: block;
        height: 10px;
        width: 10px;
    }

    .owl-theme .owl-dots .owl-dot.active span,
    .owl-theme .owl-dots .owl-dot:hover span {
        background: #000;
    }
</style>
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img src="{{ asset('img/product/' . $product->imgproduct) }}" alt="Product Image">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $product->productname }}</h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </div>
                    <div class="product__details__price">{{ number_format($product->price, 0, ',', '.') }} VND</div>
                    <p>{!! htmlspecialchars_decode($product->description) !!}</p>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div id="productData" data-quantity="{{ $product->quantity }}"></div>
                            <button id="decrease-btn" class="pro-qty-btn">-</button>
                            <div class="pro-qty">
                                <input type="number" id="productQuantity" value="1" min="1" max="{{ $product->quantity }}">
                            </div>
                            <button id="increase-btn" class="pro-qty-btn">+</button>
                        </div>
                    </div>
                    <a href="#" class="primary-btn" data-product-id="{{ $product->id }}" onclick="addToCart(this)">Thêm vào giỏ hàng</a>
                    <!-- <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a> -->
                    <ul>
                        <li><b>Số lượng còn</b> <span>
                                {{ $product->quantity }}
                            </span></li>
                        <li><b>Danh mục</b> <span>
                                {{ $product->category->categoryname }}
                            </span></li>
                        <li><b>Thương Hiệu</b> <span>{{ $product->brand->brandname }}</span></li>
                        <li><b>Thể loại</b> <span>
                                @if($product->human == 1)
                                Trẻ em
                                @elseif($product->human == 2)
                                Nam
                                @elseif($product->human == 4)
                                Nam & Nữ
                                @else
                                Nữ
                                @endif
                            </span></li>
                        <!-- <li><b>sản phẩm cùng hãng</b>
                            <div class="share">
                                <div class="product__details__pic__slider owl-carousel">
                                    @foreach($productsSameBrand as $productBrand)
                                    <img data-imgbigurl="{{ asset('img/product/' . $productBrand->imgproduct) }}" src="{{ asset('img/product/' . $productBrand->imgproduct) }}" alt="{{ $productBrand->productname }}">
                                    @endforeach
                                </div>
                            </div>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="related-product" style="background-color: #eee;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Sản phẩm cùng thương hiệu</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="product__details__pic__slider owl-carousel">
                    @php
                    $count = $productsSameBrand->count();
                    @endphp
                    @foreach($productsSameBrand as $productBrand)
                    @if($loop->iteration <= $count) {{-- Kiểm tra nếu là số lượng sản phẩm hiện tại không quá tổng số sản phẩm --}} <div class="item">
                        <img data-imgbigurl="{{ asset('img/product/' . $productBrand->imgproduct) }}" src="{{ asset('img/product/' . $productBrand->imgproduct) }}" alt="{{ $productBrand->productname }}">
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>

<section class="related-product" style="background-color:#eee;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Sản phẩm liên quan</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($productsSameCategory as $productCategory)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('img/product/' . $productCategory->imgproduct) }}">
                        <ul class="product__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">{{ $productCategory->productname }}</a></h6>
                        <h5>{{ number_format($productCategory->price, 0, ',', '.') }} VND</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Owl Carousel JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script>
    function addToCart() {
        var productId = $('.primary-btn').data('product-id');
        var quantity = parseInt($('#productQuantity').val()); // Lấy số lượng từ ô nhập liệu

        $.ajax({
            url: "{{ route('addToCart', ['id' => ':id']) }}".replace(':id', productId),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                quantity: quantity // Gửi số lượng cùng với request
            },
            success: function(response) {
                // Hiển thị swal thành công
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Sản phẩm đã được thêm vào giỏ hàng',
                });
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi (nếu cần)
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $(".product__details__pic__slider").owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 3
                },
                1024: {
                    items: 4
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        var initialQuantity = 1; // Đặt số lượng ban đầu từ phản hồi của máy chủ của bạn
        var availableQuantity = $("#productData").data("quantity");

        updateQuantityButtons(initialQuantity, availableQuantity);

        // Hàm cập nhật nút số lượng dựa trên số lượng hiện tại
        function updateQuantityButtons(currentQuantity, availableQuantity) {
            if (currentQuantity === 1) {
                $('#decrease-btn').prop('disabled', true);
            } else {
                $('#decrease-btn').prop('disabled', false);
            }

            if (currentQuantity === availableQuantity) {
                $('#increase-btn').prop('disabled', true);
            } else {
                $('#increase-btn').prop('disabled', false);
            }
        }

        // Xử lý sự kiện khi nút giảm số lượng được nhấn
        $('#decrease-btn').on('click', function() {
            var currentQuantity = parseInt($('#productQuantity').val());
            if (currentQuantity > 1) {
                currentQuantity--;
                $('#productQuantity').val(currentQuantity);
                updateQuantityButtons(currentQuantity, availableQuantity);
            }
        });

        // Xử lý sự kiện khi nút tăng số lượng được nhấn
        $('#increase-btn').on('click', function() {
            var currentQuantity = parseInt($('#productQuantity').val());
            if (currentQuantity < availableQuantity) {
                currentQuantity++;
                $('#productQuantity').val(currentQuantity);
                updateQuantityButtons(currentQuantity, availableQuantity);
            }
        });

        // Xử lý sự kiện khi giá trị số lượng thay đổi
        $('#productQuantity').on('change', function() {
            var currentQuantity = parseInt($(this).val());
            if (isNaN(currentQuantity) || currentQuantity < 1) {
                currentQuantity = 1;
            } else if (currentQuantity > availableQuantity) {
                currentQuantity = availableQuantity;
            }
            $(this).val(currentQuantity);
            updateQuantityButtons(currentQuantity, availableQuantity);
        });
    });
    
</script>