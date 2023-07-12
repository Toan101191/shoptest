@extends('layout.admin')
@section('name','Sửa danh mục sản phẩm')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route ('category.update' ,['category'=>$category->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group">
                                        <label>Id danh mục</label>
                                        <input disabled="disabled" type="text" name="id" value="{{ old('id',$category->id) }}" placeholder="Nhập tên danh mục" class="form-control" id="userName">
                                    </div>
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <input type="text" name="categoryname" value="{{ old('categoryname',$category->categoryname) }}" placeholder="Nhập tên danh mục" class="form-control" id="userName">
                                    </div>
                                    <div class="form-group text-right mb-0">
                                        <button class="btn btn-success waves-effect waves-light mr-1" type="submit">
                                            <i class="fas fa-save"></i> Lưu
                                        </button>
                                        <a href="{{route('category.index')}}" type="reset" class="btn btn-secondary waves-effect">
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

@endsection