@extends('layout.admin')
@section('name','Cập nhật hoá đơn')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route ('oder.update' ,['oder'=>$oder->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group">
                                        <label>Id danh mục</label>
                                        <input disabled="disabled" type="text" name="id" value="{{ old('id',$oder->id) }}" placeholder="Nhập tên danh mục" class="form-control" id="userName">
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select name="status" class="form-control" id="status">
                                            <option value="1" {{ old('status', $oder->status) == 1 ? 'selected' : '' }}>Đang xử lý</option>
                                            <option value="2" {{ old('status', $oder->status) == 2 ? 'selected' : '' }}>Đang giao</option>
                                            <option value="3" {{ old('status', $oder->status) == 3 ? 'selected' : '' }}>Đã nhận</option>
                                            <option value="4" {{ old('status', $oder->status) == 4 ? 'selected' : '' }}>Đã hủy</option>
                                        </select>
                                    </div>
                                    <div class="form-group text-right mb-0">
                                        <button class="btn btn-success waves-effect waves-light mr-1" type="submit">
                                            <i class="fas fa-save"></i> Lưu
                                        </button>
                                        <a href="{{route('oder.index')}}" type="reset" class="btn btn-secondary waves-effect">
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