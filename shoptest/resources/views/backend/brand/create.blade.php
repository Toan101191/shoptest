@extends('layout.admin')
@section('name','Thêm thương hiệu')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('brand.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group">
                                        <label>Tên thương hiệu</label>
                                        <input type="text" name="brandname" parsley-trigger="change" required="" placeholder="Nhập tên thương hiệu" class="form-control" id="userName">
                                    </div>

                                    <div class="form-group text-right mb-0">
                                        <button class="btn btn-success waves-effect waves-light mr-1" type="submit">
                                            <i class="fas fa-save"></i> Lưu
                                        </button>
                                        <a href="{{route('brand.index')}}" type="reset" class="btn btn-secondary waves-effect">
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

@endsection