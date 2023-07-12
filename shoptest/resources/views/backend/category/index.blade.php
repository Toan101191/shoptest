@extends('layout.admin')
@section('name','Tất cả danh mục sản phẩm')
@section('content')
<style>
    .search-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.input-group {
    flex: 1;
    display: flex;
}

.input-group-append {
    display: flex;
    align-items: center;
}

.mt-2 {
    margin-top: 2rem;
}
</style>
<div class="card">
<div class="search-container">
    <form action="{{ route('category.index') }}" method="GET">
        <div class="input-group">
            <input type="text" name="search" placeholder="Tìm kiếm" class="form-control">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit"><i class="pe-7s-search"></i></button>
            </div>
        </div>
    </form>
    @if ($searched)
        @if ($list_category->count() > 0)
            <div class="text-right mt-2">
                <a href="{{ route('category.index') }}" class="btn btn-secondary"><i class="fas fa-sync"></i> Tải lại</a>
            </div>
        @else
        <p>Không tìm thấy danh mục sản phẩm.</p>
            <div class="text-right mt-2">
                <a href="{{ route('category.index') }}" class="btn btn-secondary"><i class="fas fa-sync"></i> Tải lại</a>
            </div>
        @endif
    @endif
</div>
    <div class="card-body">
        <table class="table table-bordered">
            <div class="row">
                <form action="{{route('category.xall')}}" method="post">
                    @csrf
                    <div class="col-md-6 text-left">
                        <button type="submit" class="btn btn-dark"><i class="fas fa-trash"></i> Xoá tất cả </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{route('category.create')}}" class="btn  btn-success">
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
                                Tên danh mục
                            </th>
                            <th>
                                Chức năng
                            </th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($list_category as $category)
                        <tr>
                            <td>
                                <input value="{{ $category->id }}" type="checkbox" name="gen[]">
                            </td>
                            <td>
                                {{ $category->id }}
                            </td>
                            <td>
                                {{ $category->categoryname }}
                            </td>
                            <td>
                                <a href="{{route('category.edit',['category'=>$category->id])}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Sửa</a>
                                <a href="{{route('category.delete',['category'=>$category->id])}}" onclick="return confirm('Bạn có muốn xoá không ?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Xoá</a>
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