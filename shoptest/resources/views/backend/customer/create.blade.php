@extends('layout.admin')
@section('name','Thêm người dùng')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('customer.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group">
                                        <label>Tên người dùng</label>
                                        <input type="text" name="customername" parsley-trigger="change" required="" placeholder="Nhập tên người dùng" class="form-control" id="userName">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>sdt</label>
                                        <input type="text" name="phone" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" name="address" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="image" id="image">
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh người dùng</label>
                                        <img id="previewImg" src="#" alt="" style="max-width: 100px; max-height: 150px;">
                                    </div>
                                    <div class="form-group">
                                        <label>mật khẩu</label>
                                        <input type="password" name="password"  class="form-control">
                                    </div>
                                    <div class="form-group text-right mb-0">
                    <button class="btn btn-success waves-effect waves-light mr-1" type="submit">
                        <i class="fas fa-save"></i> Lưu
                    </button>
                    <a href="{{route('customer.index')}}" type="reset" class="btn btn-secondary waves-effect">
                        Quay lại
                    </a>
                </div>
        </form>
    </div>

</div>
</div>

</div>
</div><!-- end col-->

</div>
</form>
</div>
</div>
<script>
    document.getElementById('image').addEventListener('change', function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
@endsection