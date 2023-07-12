@extends('layout.admin')
@section('name', 'chi tiết người dùng')
@section('content')

<div class="container"> <!-- Bọc toàn bộ nội dung trong một container -->

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    Id
                </th>
                <th>
                    Tên người dùng
                </th>
                <th>
                    Email
                </th>
                <th>
                    Số điện thoại
                </th>
                <th>
                    Địa chỉ
                </th>
                <th>
                    Hình ảnh
                </th>
                <th>
                    Mật khẩu
                </th>
                <th>
                    Quyền
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{ $customer->id }}
                </td>
                <td>
                    {{ $customer->customername }}
                </td>
                <td>
                    {{ $customer->email }}
                </td>
                <td>
                    {{ $customer->phone }}
                </td>
                <td>
                    {{ $customer->address }}
                </td>
                <td>
                    <img width="80" src="{{ asset('img/product/' . $customer->image) }}" alt="customer Image">
                </td>
                <td>
                    {{ str_repeat('*', strlen($customer->password)) }}
                </td>
                <td>
                    {{ $customer->role->rolename }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
