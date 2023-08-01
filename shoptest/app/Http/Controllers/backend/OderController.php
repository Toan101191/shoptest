<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Oder;
use App\Models\Customer;
class OderController extends Controller
{

    public function Invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }public function Customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function index()
    {
        $list_oder = Oder::get();
        $sorted_oder = $list_oder->sortBy('status');
        return view('backend.oder.index', compact('sorted_oder'));
    }

    public function edit(string $id)
    {
        $oder = Oder::find($id);
        return view('backend.oder.edit', compact('oder'));
    }

    public function update(Request $request, string $id)
    {
        $oder = Oder::find($id);
        $oder->status = $request->status;
        $oder->created_at = date('Y-m-d H:i:s');
        if ($oder->save()) {
            return redirect()->route('oder.index')->with('successMsg', 'Sửa thành công');
        } else {
            return redirect()->route('oder.index')->with('errorMsg', 'Không thể sửa ');
        }
    }
}
