@extends('layout.admin')
@section('name','Sửa người dùng')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('customer.update',['customer'=>$customer->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group">
                                        <label>Tên người dùng</label>
                                        <input type="text" name="customername" value="{{ old('customername',$customer->customername) }}" placeholder="Nhập tên người dùng" class="form-control" id="userName">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        @if(session('role_id') != 1 && $customer->role_id == 1)
                                        <input type="text" name="email" value="{{ $customer->email }}" class="form-control" readonly>
                                        @else
                                        <input type="text" name="email" value="{{ $customer->email }}" class="form-control">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>sdt</label>
                                        <input type="text" name="phone" value="{{ old('phone',$customer->phone) }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" name="address" value="{{ old('address',$customer->address) }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="image" value="{{ old('image',$customer->image) }}" id="image">
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh người dùng</label>
                                        <img id="previewImg" src="#" alt="" style="max-width: 100px; max-height: 150px;">
                                    </div>
                                    <div class="form-group">
                                        <label>Mật khẩu</label>
                                        @if(session('role_id') == 1)
                                        <input type="password" name="password" class="form-control" placeholder="Không sửa thì không cần nhập">
                                        @else
                                        @if($customer->role_id == 1)
                                        <input type="password" name="password" class="form-control" placeholder="Không thay đổi" readonly>
                                        <small class="text-danger">Bạn không có quyền sửa</small>
                                        @else
                                        <input type="password" name="password" class="form-control" placeholder="Không sửa thì không cần nhập">
                                        @endif
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Quyền</label>
                                        <select name="role_id" class="form-control" required @if (session('role_id') !=1) disabled @endif>
                                            <option value="">Chọn danh mục</option>
                                            @foreach ($list_role as $role)
                                            @if (session('role_id') == 1 || $customer->role_id == $role->id)
                                            <option value="{{ $role->id }}" {{ $customer->role_id == $role->id ? 'selected' : '' }}>
                                                {{ $role->rolename }}
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @if (session('role_id') != 1)
                                        <small class="text-danger">Bạn không có quyền sửa</small>
                                        @endif
                                    </div>

                                    <div class="form-group text-right mb-0">
                                        <button class="btn btn-success waves-effect waves-light mr-1" type="submit">
                                            <i class="fas fa-save"></i> Lưu
                                        </button>
                                        <a href="{{route('customer.index')}}" type="reset" class="btn btn-secondary waves-effect">
                                            Quay lại
                                        </a>
                                    </div>
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