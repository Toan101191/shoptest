@extends('layout.admin')
@section('name','Tất cả hoá đơn')
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <div class="row">
                <form action="{{route('invoice.xall')}}" method="post">
                    @csrf
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
                                Ngày giao dịch
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
                                Tổng tiền
                            </th>
                            <th>
                                Chức năng
                            </th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($list_invoice as $invoice)
                        <tr>
                            <td>
                                <input value="{{ $invoice->id }}" type="checkbox" name="gen[]">
                            </td>
                            <td>
                                {{ $invoice->id }}
                            </td>
                            <td>
                                {{ $invoice->orderdate }}
                            </td>
                            <td>
                                {{ $invoice->customer->customername  }}
                            </td>
                            <td>
                                {{ $invoice->customer->address  }}
                            </td>
                            <td>
                                {{ $invoice->customer->phone  }}
                            </td>
                            <td>
                                {{ $invoice->total  }}
                            </td>
                            <td>
                                <a href="{{route('invoice.show',['invoice'=>$invoice->id])}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Xem</a>
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