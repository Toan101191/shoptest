@extends('layout.admin')
@section('name','Tất cả thương hiệu')
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

    .pagination {
        display: inline-block;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
    }

    .pagination a.active {
        background-color: #4CAF50;
        color: white;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
</style>
<div class="card">
    <div class="search-container">
        <form action="{{ route('brand.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" placeholder="Tìm kiếm" class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="pe-7s-search"></i></button>
                </div>
            </div>
        </form>
        @if ($searched && $list_brand->count() > 0)
        <div class="text-right mt-2">
            <a href="{{ route('brand.index') }}" class="btn btn-secondary"><i class="fas fa-sync"></i> Tải lại</a>
        </div>
        @elseif ($searched && $list_brand->count() === 0)
        <p class="mt-2">Không tìm thấy thương hiệu.</p>
        <div class="text-right mt-2">
            <a href="{{ route('brand.index') }}" class="btn btn-secondary"><i class="fas fa-sync"></i> Tải lại</a>
        </div>
        @endif
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <div class="row">
                <form action="{{route('brand.xall')}}" method="post">
                    @csrf
                    <div class="col-md-6 text-left">
                        <button type="submit" class="btn  btn-danger"><i class="fas fa-trash"></i> Xoá tất cả </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{route('brand.create')}}" class="btn  btn-success">
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
                                Tên thương hiệu
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
                        @foreach ($list_brand as $brand)
                        <tr>
                            <td>
                                <input value="{{ $brand->id }}" type="checkbox" name="gen[]">
                            </td>
                            <td>
                                {{ $brand->id }}
                            </td>
                            <td>
                                {{ $brand->brandname }}
                            </td>
                            <td>
                                <img width="80" src="{{ asset('img/product/' . $brand->image) }}" alt="brand Image">
                            </td>
                            <td>
                                <a href="{{route('brand.edit',['brand'=>$brand->id])}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Sửa</a>
                                <a href="{{route('brand.delete',['brand'=>$brand->id])}}" onclick="return confirm('Bạn có muốn xoá không ?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Xoá</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </form>
            </div>
        </table>
    </div>
    <div class="pagination">
        @if ($list_brand->onFirstPage())
        <a class="disabled" href="#">&laquo;</a>
        @else
        <a href="{{ $list_brand->previousPageUrl() }}">&laquo;</a>
        @endif

        @foreach ($list_brand->getUrlRange(1, $list_brand->lastPage()) as $page => $url)
        <a class="{{ $page == $list_brand->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
        @endforeach

        @if ($list_brand->hasMorePages())
        <a href="{{ $list_brand->nextPageUrl() }}">&raquo;</a>
        @else
        <a class="disabled" href="#">&raquo;</a>
        @endif
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