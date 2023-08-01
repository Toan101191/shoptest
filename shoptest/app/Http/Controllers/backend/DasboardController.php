<?php

namespace App\Http\Controllers\backend;

use App\Models\Customer; // Import the Customer model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DasboardController extends Controller
{
    function index()
    {
        return view('backend.dasboard.index');
    }
    public function dashboard()
    {
        $customer = Auth::customer();

        // Lấy dữ liệu từ bảng customer
        $customers = Customer::all(); // Lấy tất cả các dòng trong bảng customer

        // Chuyển dữ liệu cho người dùng trong view
        return view('admin.dashboard', ['customer' => $customer]);
    }
}
