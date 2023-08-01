@extends('fontend.index')
@section('content')
<style>
    .checkout__input input {
        font-weight: bold;
        color: #000
    }

    /* Trong file CSS hoặc trong thẻ <style> trong trang view */
    .custom-input {
        font-weight: bold;
        /* Để làm chữ đậm */
        text-align: right;
        /* Để căn phải */
        color: #000;
        /* Để đảm bảo chữ có màu đen (đen bền) */
        background-color: #f0f0f0;
        /* Màu nền của input */
        border: none;
        /* Loại bỏ viền input */
        padding: 5px 10px;
        /* Khoảng cách giữa chữ và viền của input */
        width: 100%;
        /* Để input chiếm toàn bộ phần tử chứa nó */
    }
</style>
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Chi tiết thanh toán</h4>
            <form action="{{ route('placeOrder') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <input style="display: none;" type="text" name="customer_id" value="{{ session('customer_id') }}" readonly>
                                </div>
                                <div class="checkout__input">
                                    <p>Họ và tên<span>*</span></p>
                                    <input type="text" style="font-weight: bold;" value="{{ session('customername') }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ<span>*</span></p>
                            <input type="text" class="checkout__input__add" style="font-weight: bold;" value="{{ session('address') }}" readonly>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>số điện thoại<span>*</span></p>
                                    <input type="text" style="font-weight: bold;" value="{{ session('phone') }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" style="font-weight: bold;" value="{{ session('email') }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Ghi chú đơn hàng<span>*</span></p>
                            <input type="text" name="note" placeholder="Nhập ghi chú">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="checkout__order">
                            <h4>đơn đặt hàng của bạn</h4>
                            <div style="max-height: 350px; overflow-y: auto;">
                                <table class="table table-bordered table-striped">
                                    <thead style="background-color: #7fad40; text-align: center;">
                                        <tr>
                                            <th style="display: none;">Id</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Hình ảnh</th>
                                            <th>Số lượng</th>
                                            <th>Tổng</th>
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
                                            <td style="display: none;">
                                                <input type="text" name="product_id[]" value="{{$item['productId']}} ">
                                            </td>
                                            <td class="shoping__cart__item">
                                                <h5>{{ $item['product']->productname }}</h5>
                                            </td>
                                            <td class="shoping__cart__img">
                                                <img width="100" height="70" src="{{ asset('img/product/' . $item['product']->imgproduct) }}" alt="Product Image">
                                            </td>
                                            <td class="shoping__cart__quantity" style="max-width: 100px;">
                                                <div class="quantity">
                                                    <input type="text" style="text-align: center;" 
                                                    class="custom-input" readonly name="quantity_{{ $item['productId'] }}" value="{{ $item['quantity'] }}">
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                <span class="row-total" id="row-total-{{ $itemIndex }}">
                                                    {{ number_format($subtotal) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>Thời gian đặt hàng: <span id="current-time">{{ $orderTime->toDateTimeString() }}</span></div>
                            <div class="checkout__order__subtotal">Tổng phụ <span>{{ number_format($total) }}</span></div>
                            <div class="checkout__order__subtotal">VAT <span>5%</span></div>
                            <div class="checkout__order__subtotal">Ship <span>30.000</span></div>
                            <div class="checkout__order__total">Thực tế <span>
                                <input class="custom-input" type="text" name="total" 
                                value="{{ number_format($total + ($total * 0.05 + 30000)) }} VND" redonly></span></div>
                            <div class="checkout__input__checkbox">
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Thanh Toán khi nhận hàng
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Ví điện tử
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</section>
<script src="https://unpkg.com/sweetalert@latest"></script>

<script>
    function updateOrderTime() {
    const currentTime = new Date();
    const timezoneOffset = 7; // Điều chỉnh đối với múi giờ của Hồ Chí Minh (UTC+7)
    currentTime.setHours(currentTime.getHours() + timezoneOffset);
    const formattedTime = currentTime.toISOString().slice(0, 19).replace("T", " ");
    document.getElementById('current-time').innerText = formattedTime;
}
updateOrderTime();
</script>
<script>
    function removeNonNumericChars() {
        const totalInput = document.querySelector('input[name="total"]');
        const totalValue = totalInput.value.replace(/[^0-9]/g, ''); // Loại bỏ các ký tự không phải số
        totalInput.value = totalValue;
    }
</script>
@endsection