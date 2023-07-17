@extends('layout.admin')
@section('name','Thêm slide')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('slide.store')}}" method="post" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group">
                                        <label for="slidetitle">Tiêu đề slide</label>
                                        <textarea name="slidetitle" id="slidetitle" placeholder="Nhập tiêu đề slide" class="form-control" data-ckeditor></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="slide_image" id="slide_image">
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh slide</label>
                                        <img id="previewImg" src="#" alt="" style="max-width: 100px; max-height: 150px;">
                                    </div>
                                    <div class="form-group text-right mb-0">
                                        <button class="btn btn-success waves-effect waves-light mr-1" type="submit">
                                            <i class="fas fa-save"></i> Lưu
                                        </button>
                                        <a href="{{route('slide.index')}}" type="reset" class="btn btn-secondary waves-effect">
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
    document.getElementById('slide_image').addEventListener('change', function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
@endsection