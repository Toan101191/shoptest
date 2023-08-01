@extends('fontend.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    /* Tránh cột "Tên sản phẩm" bị xuống dòng */
    .table th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<section class="shoping-cart spad">
    <div class="container">
        @if (count($cartItems) > 0)
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    @if (count($cartItems) > 0)
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="shoping__product">ID</th>
                                <th>Tên sản phẩm</th>
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
                                <td>{{$itemIndex + 1}}</td> <!-- Thay đổi ở đây -->
                                <td class="shoping__cart__item">
                                    <h5>{{ $item['product']->productname }}</h5>
                                </td>
                                <td class="shoping__cart__img">
                                    <img  width="100" height="70" src="{{ asset('img/product/' . $item['product']->imgproduct) }}" alt="Product Image">
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

                                    <button class="btn btn-dark btn-remove" data-product-id="{{ $item['product']->id }}">Xoá</button>
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
                    <a href="/" class="btn - btn-primary">Tiếp tục mua sắm</a>
                    <a href="#" class="btn btn-danger" id="update-cart-btn">
                        <i class="fa fa-loader"></i>Cập nhật giỏ hàng
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <a href="{{ route('layout.order') }}" class="primary-btn" id="btnOrder">Thanh Toán</a>
                </div>
                @endif
            </div>
        </div>
        @else
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Không có sản phẩm nào trong giỏ hàng!</strong>
            <a href="/">Click vào đây để tiếp tục mua hàng.</a>
        </div>
        @endif
    </div>
</section>
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
                Swal.fire({
                    icon: 'success',
                    title: 'Đã cập nhật giỏ hàng!',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didClose: function() {
                        location.reload(); // Reload lại trang
                    }
                });
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Nhúng thư viện jQuery -->

<script>
    // Xoá sản phẩm khỏi giỏ hàng
    $('.btn-remove').click(function() {
        console.log('Click on Remove button');
        var productId = $(this).data('product-id');
        console.log('Xoá sản phẩm với ID: ' + productId);

        // Gửi Ajax request
        $.ajax({
            url: "{{ route('cart.removeItem', ':productId') }}".replace(':productId', productId),
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                _method: "POST"
            },
            success: function(response) {
                console.log('Kết quả thành công:', response);
                if (response.success) {
                    // Xoá thành công, cập nhật lại giao diện
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
                } else {
                    // Xử lý thông báo lỗi (nếu có)
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Không tìm thấy sản phẩm trong giỏ hàng',
                    });
                }
            },
            error: function(error) {
                console.log('Lỗi Ajax:', error);
                // Xử lý lỗi (nếu có)
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Có lỗi xảy ra khi xóa sản phẩm',
                });
            }
        });
    });
</script>

@endsection