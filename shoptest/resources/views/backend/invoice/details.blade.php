@extends('layout.admin')
@section('name','Chi tiết hoá đơn')
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <div class="row">
                @csrf
                <div class="col-md-6 text-left">
                </div>
                <thead>
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Sản phẩm
                        </th>
                        <th>
                            Ảnh sản phẩm
                        </th>
                        <th>
                            Số lượng
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($invoiceDetails as $invoiceDetails)
                    <tr>
                        <td>
                            {{ $invoiceDetails->id }}
                        </td>
                        <td>
                            {{ $invoiceDetails->product->productname }} 
                        </td>
                        <td>
                        <img width="80" height="60" src="{{ asset('img/product/' . $invoiceDetails->product->imgproduct) }}" alt="Product Image">
                        </td>
                        <td>
                            {{ $invoiceDetails->quantity }}
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