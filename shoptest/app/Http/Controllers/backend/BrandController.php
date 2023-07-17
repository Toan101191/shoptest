<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;



class BrandController extends Controller
{
 
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $query = Brand::query();
    
        if ($searchTerm) {
            $query->where('brandname', 'LIKE', '%' . $searchTerm . '%');
        }
    
        $list_brand = $query->paginate(5);
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

    public function delete(Request $request, $id)
    {

        $brand = Brand::find($id);
        $past_dir = "img/product/";
        $path_image_delete = public_path($past_dir . $brand->image);
        if ($brand == null) {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'msg' => 'Không thể thay đổi trạng thái']);
        } else {
            if ($brand->delete()) {
                if (File::exists($path_image_delete)) {
                    File::delete($path_image_delete);
                }
                $file = $request->file('image');
                if ($file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = $brand->slug . '.' . $extension;
                    $file->move($past_dir, $filename);
                    $brand->image = $filename;
                }
                return redirect()->route('brand.index')->with('successMsg', 'Xóa thành công');
            }
        }
    }

    public function store(Request $request)
    {
        $brand = new Brand;
        $brand->brandname = $request->brandname;
        $brand->image = $request->image;
        $brand->created_at = date('Y-m-d H:i:s');

        if ($request->hasFile('image')) {
            $past_dir = "img/product/";
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $brand->slug . '.' . $extension;
            $file->move(public_path($past_dir), $filename);
            $brand->image = $past_dir . $filename;
        }

        if ($brand->save()) {
            return redirect()->route('brand.index')->with('successMsg', 'Thêm thành công');
        } else {
            return redirect()->route('brand.index')->with('errorMsg', 'Không thể thêm');
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

    if ($request->hasFile('image')) {
        // Xóa tệp tin cũ
        if (File::exists($brand->image)) {
            File::delete(public_path($brand->image));
        }

        // Lưu tệp tin mới
        $past_dir = "img/product/";
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = $brand->slug . '.' . $extension;
        $file->move(public_path($past_dir), $filename);
        $brand->image = $past_dir . $filename;
    }

    if ($brand->save()) {
        return redirect()->route('brand.index')->with('successMsg', 'Sửa thành công');
    } else {
        return redirect()->route('brand.index')->with('errorMsg', 'Không thể sửa');
    }
}


    public function destroy(string $id)
    {
        
    }
}
