@extends('layout.admin')
@section('name','Tất cả sản phẩm')
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
        <form action="{{ route('product.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" placeholder="Tìm kiếm" class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="pe-7s-search"></i></button>
                </div>
            </div>
        </form>
        @if ($searched && $list_product->count() > 0)
        <div class="text-right mt-2">
            <a href="{{ route('product.index') }}" class="btn btn-secondary"><i class="fas fa-sync"></i> Tải lại</a>
        </div>
        @elseif ($searched && $list_product->count() === 0)
        <p class="mt-2">Không tìm thấy sản phẩm.</p>
        <div class="text-right mt-2">
            <a href="{{ route('product.index') }}" class="btn btn-secondary"><i class="fas fa-sync"></i> Tải lại</a>
        </div>
        @endif
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <div class="row">
                <form action="{{route('product.xall')}}" method="post">
                    @csrf
                    <div class="col-md-6 text-left">
                        <button type="submit" class="btn  btn-danger"><i class="fas fa-trash"></i> Xoá tất cả </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{route('product.create')}}" class="btn  btn-success">
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
                                Tên sản phẩm
                            </th>
                            <th>
                                Hình ảnh
                            </th>
                            <th>
                                Giá
                            </th>

                            <th>
                                Chức năng
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_product as $product)
                        <tr>
                            <td>
                                <input value="{{ $product->id }}" type="checkbox" name="gen[]">
                            </td>
                            <td>
                                {{ $product->id }}
                            </td>
                            <td>
                                {{ $product->productname }}
                            </td>
                            <td>
                                <img width="80" src="{{ asset('img/product/' . $product->imgproduct) }}" alt="Product Image">
                            </td>
                            <td>
                                {{ number_format($product->price, 0, ',', '.') }} VND
                            </td>
                            <td>
                                <a href="{{route('product.edit',['product'=>$product->id])}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Sửa</a>
                                <a href="{{route('product.show',['product'=>$product->id])}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Xem</a>
                                <a href="{{route('product.delete',['product'=>$product->id])}}" onclick="return confirm('Bạn có muốn xoá không ?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Xoá</a>
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