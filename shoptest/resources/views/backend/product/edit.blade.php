@extends('layout.admin')
@section('name','Sửa sản phẩm')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route ('product.update' ,['product'=>$product->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group">
                                        <label>id</label>
                                        <input disabled="disabled" type="text" name="id" value="{{ old('id',$product->id) }}" placeholder="Nhập tên sản phẩm" class="form-control" id="userName">
                                    </div>
                                    <div class="form-group">
                                        <label>Tên sản phẩm</label>
                                        <input type="text" name="productname" value="{{ old('productname',$product->productname) }}" placeholder="Nhập tên sản phẩm" class="form-control" id="userName">
                                    </div>
                                    <div class="form-group">
                                        <label>Thương hiệu</label>
                                        <select name="brandid" class="form-control" required>
                                            <option value="">Chọn thương hiệu</option>
                                            @foreach ($list_brand as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brandid', $product->brandid) == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->brandname }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <select name="category_id" class="form-control" required>
                                            <option value="">Chọn danh mục</option>
                                            @foreach ($list_category as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->categoryname }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Loại</label>
                                        <div>
                                            <label class="radio-inline">
                                                <input type="radio" name="human" value="1" {{ old('outstanding', $product->human) == 1 ? 'checked' : '' }}> Trẻ em
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="human" value="2" {{ old('outstanding', $product->human) == 2 ? 'checked' : '' }}> Nam
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="human" value="3" {{ old('outstanding', $product->human) == 3 ? 'checked' : '' }}> Nữ
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="human" value="4" {{ old('outstanding', $product->human) == 4 ? 'checked' : '' }}> Nam & Nữ
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="imgproduct" value="{{ old('imgproduct',$product->imgproduct) }}" id="imgproduct" >
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh sản phẩm</label>
                                        <img id="previewImg" src="#" alt="" style="max-width: 100px; max-height: 150px;">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea  name="description" id="description"  placeholder="Nhập Mô tả" class="form-control" data-ckeditor>{!! old('description', $product->description) !!}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá</label>
                                        <input type="text" name="price" value="{{ old('price',$product->price) }}" placeholder="Nhập Giá" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>Số lượng</label>
                                        <input type="text" name="quantity" value="{{ old('quantity',$product->quantity) }}" placeholder="Nhập số lượng" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>Sản phẩm nổi bật</label>
                                        <div>
                                            <label class="radio-inline">
                                                <input type="radio" name="outstanding" value="1" {{ old('outstanding', $product->outstanding) == 1 ? 'checked' : '' }}> Có
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="outstanding" value="2" {{ old('outstanding', $product->outstanding) == 2 ? 'checked' : '' }}> Không
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group text-right mb-0">
                                        <button class="btn btn-success waves-effect waves-light mr-1" type="submit">
                                            <i class="fas fa-save"></i> Lưu
                                        </button>
                                        <a href="{{route('product.index')}}" type="reset" class="btn btn-secondary waves-effect">
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
    document.getElementById('imgproduct').addEventListener('change', function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
@endsection