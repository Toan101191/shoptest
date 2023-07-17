@extends('layout.admin')
@section('name','Sửa thương hiệu')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route ('brand.update' ,['brand'=>$brand->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group">
                                        <label>Id thương hiệu</label>
                                        <input disabled="disabled" type="text" name="id" value="{{ old('id',$brand->id) }}"  class="form-control" id="userName">
                                    </div>
                                    <div class="form-group">
                                        <label>Tên thương hiệu</label>
                                        <input type="text" name="brandname" value="{{ old('brandname',$brand->brandname) }}" placeholder="Nhập tên thương hiệu" class="form-control" id="userName">
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="image" value="{{ old('image',$brand->image) }}" id="image">
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh thương hiệu</label>
                                        <img id="previewImg" src="#" alt="" style="max-width: 100px; max-height: 150px;">
                                    </div>
                                    <div class="form-group text-right mb-0">
                                        <button class="btn btn-success waves-effect waves-light mr-1" type="submit">
                                            <i class="fas fa-save"></i> Lưu
                                        </button>
                                        <a href="{{route('brand.index')}}" type="reset" class="btn btn-secondary waves-effect">
                                            Quay lại
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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