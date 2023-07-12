@extends('layout.admin')
@section('name','Sửa quyền')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route ('role.update' ,['role'=>$role->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group">
                                        <label>Id quyền</label>
                                        <input disabled="disabled" type="text" name="id" value="{{ old('id',$role->id) }}" placeholder="Nhập tên quyền" class="form-control" id="userName">
                                    </div>
                                    <div class="form-group">
                                        <label>Tên quyền</label>
                                        <input type="text" name="rolename" value="{{ old('rolename',$role->rolename) }}" placeholder="Nhập tên quyền" class="form-control" id="userName">
                                    </div>
                                    <div class="form-group text-right mb-0">
                                        <button class="btn btn-success waves-effect waves-light mr-1" type="submit">
                                            <i class="fas fa-save"></i> Lưu
                                        </button>
                                        <a href="{{route('role.index')}}" type="reset" class="btn btn-secondary waves-effect">
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