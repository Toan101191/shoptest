@extends('layout.admin')
@section('name', 'chi tiết sản phẩm')
@section('content')

<div class="container"> <!-- Bọc toàn bộ nội dung trong một container -->

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    Id
                </th>
                <th>
                    Tên sản phẩm
                </th>
                <th>
                    Thương hiệu
                </th>
                <th>
                    Tên danh mục
                </th>
                <th>
                    Loại
                </th>
                <th>
                    Hình ảnh
                </th>
                <th>
                    Mô tả
                </th>
                <th>
                    Giá
                </th>
                <th>
                    Số lượng
                </th>
                <th>
                    sản phẩm nổi bật
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{ $product->id }}
                </td>
                <td>
                    {{ $product->productname }}
                </td>
                <td>
                    {{ $product->brand->brandname }}
                </td>
                <td>
                    {{ $product->category->categoryname }}
                </td>
                <td>
                    @if($product->human == 1)
                    Trẻ em
                    @elseif($product->human == 2)
                    Nam
                    @elseif($product->human == 4)
                    Nam & Nữ
                    @else
                    Nữ
                    @endif
                </td>
                <td>
                    <img width="80" src="{{ asset('img/product/' . $product->imgproduct) }}" alt="Product Image">
                </td>
                <td>
                {!! htmlspecialchars_decode($product->description) !!}
                </td>
                <td>
                    {{ number_format($product->price, 0, ',', '.') }} VND
                </td>
                <td>
                    {{ $product->quantity }}
                </td>
                <td>
                    @if($product->outstanding == 1)
                    Sản phẩm nổi bật
                    @else
                    Không
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection