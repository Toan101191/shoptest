@extends('layout.admin')
@section('name','Tất cả Slide')
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <div class="row">
                <form action="{{route('slide.xall')}}" method="post">
                    @csrf
                    <div class="col-md-6 text-left">
                        <button type="submit" class="btn  btn-danger"><i class="fas fa-trash"></i> Xoá tất cả </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{route('slide.create')}}" class="btn  btn-success">
                            <i class="mdi mdi-plus mr-1"></i> Thêm mới
                        </a>
                    </div>
                    <thead>
                        <tr>
                            <th style="width:30px;" class="text:center;">
                                Chọn
                            </th>
                            <th>
                                Id
                            </th>
                            <th>
                                title
                            </th>
                            <th>
                                Hình ảnh
                            </th>
                            <th>
                                Chức năng
                            </th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($list_slide as $slide)
                        <tr>
                            <td>
                                <input value="{{ $slide->id }}" type="checkbox" name="gen[]">
                            </td>
                            <td>
                                {{ $slide->id }}
                            </td>
                            <td>
                                <div class="content">{!! htmlspecialchars_decode($slide->slidetitle) !!}</div>
                            </td>

                            <td>
                                <img width="80" src="{{ asset('img/product/' . $slide->slide_image) }}" alt="slide Image">
                            </td>
                            <td>
                                <a href="{{route('slide.edit',['slide'=>$slide->id])}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Sửa</a>
                                <a href="{{route('slide.delete',['slide'=>$slide->id])}}" onclick="return confirm('Bạn có muốn xoá không ?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Xoá</a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </form>
            </div>
        </table>
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