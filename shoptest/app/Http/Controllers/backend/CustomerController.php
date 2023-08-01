<?php

namespace App\Http\Controllers\backend;

use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $list_customer = Customer::where('customername', 'LIKE', '%' . $searchTerm . '%')->get();
        $searched = $searchTerm !== null && $searchTerm !== '';

        return view('backend.customer.index', compact('list_customer', 'searched'));
    }


    public function xall(Request $request)

    {
        foreach ($request->gen as $item) {
            $customer = Customer::where('id', '=', $item);
            $customer->delete();
        }
        return redirect()->route('customer.index')->with('successMsg', 'Xóa tất cả danh mục sản phẩm thành công');
    }
    public function create()
    {
        return view('backend.customer.create');
    }

    public function store(Request $request)
    {

        $customer = new Customer;
        $customer->customername = $request->customername;
        $customer->slug = Str::slug($customer->customername = $request->customername, '-');
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->image = $request->image;
        $customer->password = bcrypt($request->password);
        $customer->role_id  = 2;
        $customer->created_at = date('Y-m-d H:i:s');
        if ($request->has('image')) {
            $past_dir = "img/product/";
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $customer->slug . '.' . $extension;
            $file->move($past_dir, $filename);
            $customer->image = $filename;
        }
        if ($customer->save()) {
            return redirect()->route('customer.index')->with('successMsg', 'Thêm thành công');
        } else {
            return redirect()->route('customer.index')->with('errorMsg', 'Không thể thêm');
        }
    }
    public function delete(Request $request, $id)
    {

        $customer = Customer::find($id);
        $past_dir = "img/product/";
        $path_image_delete = public_path($past_dir . $customer->image);
        if ($customer == null) {
            return redirect()->route('customer.index')->with('message', ['type' => 'danger', 'msg' => 'Không thể thay đổi trạng thái']);
        } else {
            if ($customer->delete()) {
                if (File::exists($path_image_delete)) {
                    File::delete($path_image_delete);
                }
                $file = $request->file('image');
                if ($file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = $customer->slug . '.' . $extension;
                    $file->move($past_dir, $filename);
                    $customer->image = $filename;
                }
                return redirect()->route('customer.index')->with('successMsg', 'Xóa thành công');
            }
        }
    }
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customer.show', compact('customer'));
    }


    public function edit($id)
    {
        $customer = Customer::find($id);
        $list_role = Role::get();
        // $customer = customer::orderby('created_at','desc')->first();
        return view('backend.customer.edit', compact('customer', 'list_role'));
    }


    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->customername = $request->customername;
        $customer->slug = Str::slug($customer->customername, '-');
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        if ($request->filled('password')) {
            $customer->password = bcrypt($request->password);
        } else {
            // Giữ nguyên mật khẩu hiện tại
            $customer->password = $customer->getOriginal('password');
        }
        $customer->role_id = $request->role_id;
        $customer->created_at = date('Y-m-d H:i:s');
        // Kiểm tra xem có tệp tin mới được chọn hay không
        if ($request->hasFile('image')) {
            // Xóa tệp tin cũ
            if (File::exists($customer->image)) {
                File::delete($customer->image);
            }

            // Lưu tệp tin mới
            $past_dir = "img/product/";
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $customer->slug . '.' . $extension;
            $file->move($past_dir, $filename);
            $customer->image = $filename;
        }
        if ($customer->save()) {
            return redirect()->route('customer.index')->with('successMsg', 'Sửa thành công');
        } else {
            return redirect()->route('customer.index')->with('errorMsg', 'Không thể sửa');
        }
    }
    public function postlogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $arr = [
            'email' => $email,
            'password' => $password
        ];

        if (Auth::attempt($arr)) {
            $customer = Auth::user(); // Lấy thông tin người dùng đã đăng nhập

            // Kiểm tra xem user có tồn tại và đã đăng nhập thành công
            if ($customer) {
                // Lưu thông tin người dùng vào session
                session([
                    'customer_id' => $customer->id,
                    'customername' => $customer->customername,
                    'email' => $customer->email,
                    'phone' => $customer->phone,
                    'address' => $customer->address,
                    'image' => $customer->image,
                    'role_id' => $customer->role_id
                ]);

                if ($request->has('remember')) {
                    // Lưu thông tin đăng nhập vào cookie trong 30 ngày
                    Cookie::queue('remember_email', $email, 43200); // 30 days
                    Cookie::queue('remember_password', $password, 43200); // 30 days
                } else {
                    // Nếu không chọn "Lưu thông tin đăng nhập", xóa cookie
                    Cookie::queue(Cookie::forget('remember_email'));
                    Cookie::queue(Cookie::forget('remember_password'));
                }

                return redirect()->route('layout.home')->with('successMsg', 'Đăng nhập thành công');
            } else {
                return redirect()->route('layout.login')->with('errorMsg', 'Sai thông tin đăng nhập');
            }
        } else {
            return redirect()->route('layout.login')->with('errorMsg', 'Sai thông tin đăng nhập');
        }
    }

    public function login()
    {
        return view('layout.login');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush(); // Xóa toàn bộ dữ liệu phiên
        return redirect()->route('layout.home')->with('successMsg', 'Đăng xuất thành công');
    }
}
