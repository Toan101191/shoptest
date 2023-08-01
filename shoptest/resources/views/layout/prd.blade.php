@extends('fontend.index')
@section('content')

<style>
    ul li:hover {
        background-color: #eee;
        transform: scale(1.1);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    #productList {
        grid-template-columns: repeat(3, 1fr);
        /* Hiển thị 3 sản phẩm trong 1 hàng */
    }

    .product__item {
        display: block;
    }

    .product__item.hide {
        display: none;
    }

    .pagination {
        display: inline-block;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
    }

    .pagination a.active {
        background-color: #4CAF50;
        color: white;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
    .underline-container {
        position: relative;
        margin-bottom: 10px;
        padding: 1;
    }

    .underline-container::after {
        content: "";
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        border-bottom: 4px solid #7fad39;
    }

</style>

<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <div class="underline-container">
                            <h4>Thương Hiệu</h4>
                        </div>
                        <ul>
                            @foreach ($list_brand as $brand)
                            <li><a href="#"><b>
                            {{ $brand->brandname }}
                            </b></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>Sản phẩm mới nhất</h2>
                    </div>
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">
                            @foreach ($latestProducts as $product)
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="{{ asset('img/product/' . $product->imgproduct) }}">
                                        <div class="product__discount__percent">mới</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="{{route('layout.details',['product'=>$product->id])}}">
                                                    <i class="fa fa-eye"></i></a></li>
                                            <li>
                                                <a href="#" data-product-id="{{ $product->id }}" onclick="event.preventDefault(); addToCart(this);">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>Dried Fruit</span>
                                        <h5><a href="#">{{ $product->productname }}</a></h5>
                                        <div class="product__item__price">{{ number_format($product->price, 0, ',', '.') }} VND</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <div class="filter__item">
                        <div class="section-title product__discount__title">
                            <h2>Toàn bộ sản phẩm</h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Lọc Theo</span>
                                    <select onchange="filterItems(this.value)">
                                        <option value="*">Tất cả</option>
                                        @foreach ($list_category as $category)
                                        <option value="{{ $category->categoryname }}">{{ $category->categoryname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="productList">
                        <!-- Hiển thị tất cả sản phẩm khi trang vừa load -->
                        @foreach ($list_product as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6 mix category-{{ $product->category_id }} product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset('img/product/' . $product->imgproduct) }}">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="{{route('layout.details',['product'=>$product->id])}}">
                                            <i class="fa fa-eye"></i></a></li>
                                    <li>
                                        <a href="#" data-product-id="{{ $product->id }}" onclick="event.preventDefault(); addToCart(this);">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                </ul>
                                <span class="category-badge" style="opacity: 0;">{{ $product->category->categoryname }}</span>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{ $product->category->categoryname }}</a></h6>
                                <h5>{{ number_format($product->price, 0, ',', '.') }} VND</h5>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="pagination">
                        <a href="{{ $list_product->previousPageUrl() }}">&laquo;</a>
                        @foreach ($list_product->getUrlRange(1, $list_product->lastPage()) as $page => $url)
                        <a class="{{ $page == $list_product->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
                        @endforeach
                        <a href="{{ $list_product->nextPageUrl() }}">&raquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<!-- Đầu tiên, thêm phiên bản mới của thư viện Swal -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Đoạn mã JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                Swal.fire({
                    title: 'Thành công',
                    text: 'Sản phẩm đã được thêm vào giỏ hàng',
                    icon: 'success',
                    timer: 2000, // Thời gian hiển thị (ms)
                    showConfirmButton: false,
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
<script>
    // Tạo biến lưu trữ danh sách sản phẩm gốc (không lọc)
    var allProducts = document.querySelectorAll('.product__item');

    function filterItems(filter) {
        var items = document.querySelectorAll('.product__item');
        items.forEach(function(item) {
            var productCategory = item.querySelector('.product__item__text a').innerText.trim();
            if (filter === '*' || productCategory === filter) {
                item.classList.remove('hide');
            } else {
                item.classList.add('hide');
            }
        });

        // Nếu filter là '*' (tất cả), hiển thị toàn bộ sản phẩm gốc
        if (filter === '*') {
            allProducts.forEach(function(item) {
                item.classList.remove('hide');
            });
        }
    }
</script>