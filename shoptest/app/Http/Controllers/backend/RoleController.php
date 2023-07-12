<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $list_role = Role::get();
        return view('backend.role.index', compact('list_role'));
    }

    public function xall(Request $request)

    {
        foreach ($request->gen as $item) {
            $role = Role::where('id', '=', $item);
            $role->delete();
        }
        return redirect()->route('role.index')->with('successMsg', 'Xóa tất cả danh mục sản phẩm thành công');
    }
    public function create()
    {
        return view('backend.role.create');
    }

    public function store(Request $request)
    {

        $role = new Role;
        $role->rolename = $request->rolename;
        $role->created_at = date('Y-m-d H:i:s');

        if ($role->save()) {
            return redirect()->route('role.index')->with('successMsg', 'Thêm thành công');
        } else {
            return redirect()->route('role.index')->with('errorMsg', 'Không thể thêm');
        }
    }
    public function delete($id)
    {
        $role = Role::find($id);
        if ($role == null) {
            return redirect()->route('role.index')->with('message', ['type' => 'success', 'msg'
            => 'Không tồn tại']);
        } else {
            $role->delete();
            return redirect()->route('role.index')->with('successMsg', 'Xoá thành công ');
        }
    }
    public function show(string $id)
    {
        //
    }

    
    public function edit($id)
    {
        $role = Role::find($id);
        // $role = role::orderby('created_at','desc')->first();
        return view('backend.role.edit', compact('role'));
    }


    public function update(Request $request, $id)
    {

        $role = Role::find($id);
        $role->rolename = $request->rolename;
        $role->created_at = date('Y-m-d H:i:s');
        if ($role->save()) {
            return redirect()->route('role.index')->with('successMsg', 'Sửa thành công');
        } else {
            return redirect()->route('role.index')->with('errorMsg', 'Không thể sửa ');
        }
    }

    
    public function destroy(string $id)
    {
        //
    }
}
