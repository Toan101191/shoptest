<?php

namespace App\Http\Controllers\backend;

use App\Models\Invoice;
use App\Models\Invoice_details;
use App\Models\Product;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }public function Customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function index()
    {
        $list_invoice = Invoice::get();
        return view('backend.invoice.index', compact('list_invoice'));
    }

    public function xall(Request $request)

    {
        foreach ($request->gen as $item) {
            $invoice = Invoice::where('id', '=', $item);
            $invoice->delete();
        }
        return redirect()->route('brand.index')->with('successMsg', 'Xóa tất cả thương hiệu thành công');
    }


    public function show($id)
    {
        // Tìm hoá đơn bằng id
        $invoice = Invoice::find($id);

        // Kiểm tra xem có tìm thấy hoá đơn hay không
        if (!$invoice) {
            return redirect()->route('invoice.index')->with('errorMsg', 'Không tìm thấy hoá đơn');
        }

        // Lấy danh sách chi tiết hoá đơn (nếu cần) và nạp thông tin sản phẩm
        $invoiceDetails = Invoice_Details::where('invoice_id', $id)->with('product')->get();

        // Trả về view hiển thị thông tin hoá đơn và chi tiết hoá đơn (nếu có)
        return view('backend.invoice.details', compact('invoice', 'invoiceDetails'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }
}
