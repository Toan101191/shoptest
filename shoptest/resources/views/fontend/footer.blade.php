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