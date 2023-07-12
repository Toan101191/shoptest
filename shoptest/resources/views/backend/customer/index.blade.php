@extends('layout.admin')
@section('name','Tất cả người dùng')
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
        <form action="{{ route('customer.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" placeholder="Tìm kiếm" class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="pe-7s-search"></i></button>
                </div>
            </div>
        </form>
        @if ($searched && $list_customer->count() > 0)
        <div class="text-right mt-2">
            <a href="{{ route('customer.index') }}" class="btn btn-secondary"><i class="fas fa-sync"></i> Tải lại</a>
        </div>
        @elseif ($searched && $list_customer->count() === 0)
        <p class="mt-2">Không tìm thấy người dùng.</p>
        <div class="text-right mt-2">
            <a href="{{ route('customer.index') }}" class="btn btn-secondary"><i class="fas fa-sync"></i> Tải lại</a>
        </div>
        @endif
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <div class="row">
                <form action="{{route('customer.xall')}}" method="post">
                    @csrf
                    <div class="col-md-6 text-left">
                        <button type="submit" class="btn  btn-danger"><i class="fas fa-trash"></i> Xoá tất cả </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{route('customer.create')}}" class="btn  btn-success">
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
                                Tên người dùng
                            </th>
                            <th>
                                Hình ảnh
                            </th>
                            <th>
                                email
                            </th>

                            <th>
                                sdt
                            </th>
                            <th>
                                Chức năng
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_customer as $customer)
                        <tr>
                            <td>
                                <input value="{{ $customer->id }}" type="checkbox" name="gen[]">
                            </td>
                            <td>
                                {{ $customer->id }}
                            </td>
                            <td>
                                {{ $customer->customername }}
                            </td>
                            <td>
                                <img width="80" src="{{ asset('img/product/' . $customer->image) }}" alt="customer Image">
                            </td>
                            <td>
                            {{ $customer->email }}
                            </td>
                            <td>
                            {{ $customer->phone }}
                            </td>
                            <td>
                                <a href="{{route('customer.edit',['customer'=>$customer->id])}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Sửa</a>
                                <a href="{{route('customer.show',['customer'=>$customer->id])}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Xem</a>
                                <a href="{{route('customer.delete',['customer'=>$customer->id])}}" onclick="return confirm('Bạn có muốn xoá không ?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Xoá</a>
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