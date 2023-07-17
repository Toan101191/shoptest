@extends('layout.admin')
@section('name','Tất cả Tin tức')
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <div class="row">
                <form action="{{route('news.xall')}}" method="post">
                    @csrf
                    <div class="col-md-6 text-left">
                        <button type="submit" class="btn  btn-danger"><i class="fas fa-trash"></i> Xoá tất cả </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{route('news.create')}}" class="btn  btn-success">
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
                                Nội dung
                            </th>
                            <th>
                                Hình ảnh
                            </th>
                            <th>
                                Người thêm
                            </th>
                            <th>
                                Loại tin
                            </th>
                            <th>
                                Chức năng
                            </th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($list_new as $new)
                        <tr>
                            <td>
                                <input value="{{ $new->id }}" type="checkbox" name="gen[]">
                            </td>
                            <td>
                                {{ $new->id }}
                            </td>
                            <td>
                                <div class="content">{!! htmlspecialchars_decode($new->newtitle) !!}</div>
                            </td>
                            <td>
                                <div class="content">{!! htmlspecialchars_decode($new->newcontent) !!}</div>
                            </td>
                            <td>
                                <img width="80" src="{{ asset('img/product/' . $new->image) }}" alt="new Image">
                            </td>
                            <td>
                                {{ $new->customer->customername }}
                            </td>
                            <td>
                                @if ($new->cat_new == 1)
                                tin thường
                                @elseif ($new->cat_new == 2)
                                tin hot
                                @endif
                            </td>
                            <td>
                                <a href="{{route('news.edit',['news'=>$new->id])}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Sửa</a>
                                <a href="{{route('news.delete',['news'=>$new->id])}}" onclick="return confirm('Bạn có muốn xoá không ?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Xoá</a>
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