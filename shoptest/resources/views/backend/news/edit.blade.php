@extends('layout.admin')
@section('name','Sửa Tin tức')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('news.update',['news'=>$new->id])}}" method="post" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group">
                                        <label for="newtitle">Tiêu đề tin tức</label>
                                        <textarea name="newtitle" id="newtitle" placeholder="Nhập tiêu đề tin tức" class="form-control" data-ckeditor>{{ old('newtitle',$new->newtitle) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="newcontent">Nội dung tin tức</label>
                                        <textarea name="newcontent" id="newcontent" placeholder="Nhập nội dung tin tức" class="form-control" data-ckeditor>{{ old('newcontent',$new->newcontent) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" value="{{ old('image',$new->image) }}" name="image" id="image">
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh Tin</label>
                                        <img id="previewImg" src="#" alt="" style="max-width: 100px; max-height: 150px;">
                                    </div>
                                    <div class="form-group">
                                        <label>Người thêm</label>
                                        <input type="text" name="customer_id" value="{{ old('new',$new->customer_id) }}" required="" placeholder="Nhập số lượng" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Loại tin</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="cat_new" value="1" {{ old('cat_new', $new->cat_new) == 1 ? 'checked' : '' }}> tin thường
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="cat_new" value="2" {{ old('cat_new', $new->cat_new) == 2 ? 'checked' : '' }}> tin hot
                                        </label>
                                    </div>
                                    <div class="form-group text-right mb-0">
                                        <button class="btn btn-success waves-effect waves-light mr-1" type="submit">
                                            <i class="fas fa-save"></i> Lưu
                                        </button>
                                        <a href="{{route('news.index')}}" type="reset" class="btn btn-secondary waves-effect">
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