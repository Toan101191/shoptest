@extends('layout.admin')
@section('name','Thêm Tin tức')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('news.store')}}" method="post" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group">
                                        <label for="newtitle">Tiêu đề tin tức</label>
                                        <textarea name="newtitle" id="newtitle" placeholder="Nhập tiêu đề tin tức" class="form-control" data-ckeditor></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="newcontent">Nội dung tin tức</label>
                                        <textarea name="newcontent" id="newcontent" placeholder="Nhập nội dung tin tức" class="form-control" data-ckeditor></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="image" id="image">
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh Tin</label>
                                        <img id="previewImg" src="#" alt="" style="max-width: 100px; max-height: 150px;">
                                    </div>
                                    <div class="form-group">
                                        <label for="customer_id">Id người thêm</label>
                                        <input type="hidden" name="customer_id" id="customer_id" value="{{ Auth::user()->id }}">
                                        <input type="text" class="form-control" id="customer_id_display" value="{{ Auth::user()->id }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="customername">Tên người thêm</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->customername }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Loại tin</label> <label class="radio-inline">
                                            <input type="radio" name="cat_new" value="1" {{ $new->cat_new == 1 ? 'checked' : '' }}> tin thường
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="cat_new" value="2" {{ $new->cat_new == 2 ? 'checked' : '' }}> tin hot
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