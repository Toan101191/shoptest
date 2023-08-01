<style>
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
    ul li:hover {
        background-color: #eee;
        transform: scale(1.1);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
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
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="/"><img src="{{ asset('asset1/img/logo.png') }}" alt=""></a>
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
                                <li><a href="#">Trang quản trị</a></li>
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