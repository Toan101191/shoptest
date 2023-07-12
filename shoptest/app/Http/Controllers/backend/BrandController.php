<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
 
    public function index(Request $request)
    {
        
        $searchTerm = $request->input('search');
        $list_brand = Brand::where('brandname', 'LIKE', '%'.$searchTerm.'%')->get();
        $searched = $searchTerm !== null && $searchTerm !== '';
    
        return view('backend.brand.index', compact('list_brand', 'searched'));
    }
    public function xall(Request $request)
    
    {
        foreach($request->gen as $item){
            $brand = Brand::where('id','=',$item);
            $brand ->delete();
        }
        return redirect()->route('brand.index')->with('successMsg', 'Xóa tất cả thương hiệu thành công');
    }
    public function create()
    {
        return view('backend.brand.create');
    }



    public function store(Request $request)
    {

        $brand = new Brand;
        $brand->brandname = $request->brandname;
        $brand->created_at = date('Y-m-d H:i:s');
        if ($brand->save()) {
            return redirect()->route('brand.index')->with('successMsg', 'Thêm thành công');
        } else {
            return redirect()->route('brand.index')->with('errorMsg', 'Không thể thêm');
        }
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            return redirect()->route('brand.index')->with('message', ['type' => 'success', 'msg'
            => 'Không tồn tại']);
        } else {
            $brand->delete();
            return redirect()->route('brand.index')->with('successMsg', 'Xoá thành công ');
        }
    }
    public function show(string $id)
    {
        
    }

 
    public function edit($id)
    {
        $brand = Brand::find($id);
        // $brand = brand::orderby('created_at','desc')->first();
        return view('backend.brand.edit', compact('brand'));
    }


    public function update(Request $request, $id)
    {

        $brand = Brand::find($id);
        $brand->brandname = $request->brandname;
        $brand->created_at = date('Y-m-d H:i:s');
        if ($brand->save()) {
            return redirect()->route('brand.index')->with('successMsg', 'Sửa thành công');
        } else {
            return redirect()->route('brand.index')->with('errorMsg', 'Không thể sửa ');
        }
    }

    public function destroy(string $id)
    {
        
    }
}
