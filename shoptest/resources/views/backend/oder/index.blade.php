@extends('layout.admin')
@section('name','Tất cả đơn hàng')
@section('content')
<style>
    .disabled-link {
        pointer-events: none;
        /* Ngăn người dùng click vào liên kết */
        color: #6c757d;
        /* Đổi màu chữ thành xám (hoặc màu tùy chọn khác tùy ý) */
        text-decoration: none;
        /* Bỏ gạch chân */
        color: #eee;
    }
</style>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <div class="row">
                <div class="col-md-6 text-left">
                    <button type="submit" class="btn  btn-danger"><i class="fas fa-trash"></i> Xoá tất cả </button>
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
                            Khách hàng
                        </th>
                        <th>
                            Địa chỉ
                        </th>
                        <th>
                            Số điện thoại
                        </th>
                        <th>
                            Mã hoá đơn
                        </th>
                        <th>
                            Tổng tiền
                        </th>
                        <th>
                            Ghi chú
                        </th>
                        <th>
                            Trạng thái
                        </th>
                        <th>
                            Chức năng
                        </th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($sorted_oder as $list_oder)
                    <tr>
                        <td>
                            <input value="{{ $list_oder->id }}" type="checkbox" name="gen[]">
                        </td>
                        <td>
                            {{ $list_oder->id }}
                        </td>
                        <td>
                            {{ $list_oder->customer->customername  }}
                        </td>
                        <td>
                            {{ $list_oder->customer->address  }}
                        </td>
                        <td>
                            {{ $list_oder->customer->phone  }}
                        </td>
                        <td>
                            {{ $list_oder->invoice_id  }}
                        </td>
                        <td>
                            {{ $list_oder->total  }}
                        </td>
                        <td>
                            {{ $list_oder->note  }}
                        </td>
                        <td>
                            @if($list_oder->status == 1)
                            Đang xử lý
                            @elseif($list_oder->status == 2)
                            Đang giao
                            @elseif($list_oder->status == 3)
                            Đã nhận
                            @elseif($list_oder->status == 4)
                            Đã hủy
                            @else
                            Trạng thái không xác định
                            @endif
                        </td>
                        <td>
                            @if($list_oder->status == 3)
                            <a href="#" class="btn btn-sm btn-dark disabled-link"> Đã nhận hàng</a>
                            @elseif($list_oder->status ==4)
                            <a href="#" class="btn btn-sm btn-dark disabled-link">Đã huỷ đơn</a>
                            @else
                            <a href="{{route('oder.edit',['oder'=>$list_oder->id])}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Cập nhật</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
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