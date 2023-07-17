@extends('layout.admin')
@section('name','Tất cả quyền')
@section('content')
<div class="card">
    <div class="card-body">
    <table class="table table-bordered">
   <div class="row">
   <form action="{{route('role.xall')}}" method="post">
    @csrf
                <div class="col-md-6 text-left">
                    <button type="submit" class="btn  btn-danger"><i class="fas fa-trash"></i> Xoá tất cả </button>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{route('role.create')}}"  class="btn  btn-success">
                        <i class="mdi mdi-plus mr-1"></i> Thêm mới
                    </a>
                </div>
            </div>
        <thead >
            <tr>
                <th style="width:30px;" class="text:center;">
                    Chọn
                </th>
                <th >
                    Id 
                </th>
                <th >
                    Tên quyền
                </th>
                <th  >
                Chức năng
                </th>
         
                </tr>
        </thead>
        <tbody>
          
           @foreach ($list_role as $role)
            <tr>
                <td>
                    <input value="{{ $role->id }}" type="checkbox" name="gen[]">
                </td>
                <td>
                {{ $role->id }}
                </td>
                <td>
                    {{ $role->rolename }}
                </td>
                <td>
                    <a href="{{route('role.edit',['role'=>$role->id])}}" 
                    class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Sửa</a>
                    <a href="{{route('role.delete',['role'=>$role->id])}}"
                    onclick="return confirm('Bạn có muốn xoá không ?')"
                     class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Xoá</a>
                </td>
          
            </tr>
            @endforeach
        </tbody>
    </table>
    </form>
</div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @if(Session::has('successMsg'))
    <script>
        swal("Thông báo", "{{Session::get('successMsg')}}", "success");
    </script>
  @endif

  @if(Session::has('errorMsg'))
    <script>
        swal("Thất bại", "{{Session::get('errorMsg')}}", "warning");
    </script>
  @endif
@endsection
