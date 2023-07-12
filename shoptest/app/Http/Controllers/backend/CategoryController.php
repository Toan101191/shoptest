<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $list_category = Category::where('categoryname', 'LIKE', '%'.$searchTerm.'%')->get();
        $searched = $searchTerm !== null && $searchTerm !== '';
    
        return view('backend.category.index', compact('list_category', 'searched'));
    }


    public function xall(Request $request)

    {
        foreach ($request->gen as $item) {
            $category = Category::where('id', '=', $item);
            $category->delete();
        }
        return redirect()->route('category.index')->with('successMsg', 'Xóa tất cả danh mục sản phẩm thành công');
    }
    public function create()
    {
        return view('backend.category.create');
    }

    public function store(Request $request)
    {

        $category = new Category;
        $category->categoryname = $request->categoryname;
        $category->created_at = date('Y-m-d H:i:s');

        if ($category->save()) {
            return redirect()->route('category.index')->with('successMsg', 'Thêm thành công');
        } else {
            return redirect()->route('category.index')->with('errorMsg', 'Không thể thêm');
        }
    }
    public function delete($id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('category.index')->with('message', ['type' => 'success', 'msg'
            => 'Không tồn tại']);
        } else {
            $category->delete();
            return redirect()->route('category.index')->with('successMsg', 'Xoá thành công ');
        }
    }

    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {
        $category = Category::find($id);
        // $category = Category::orderby('created_at','desc')->first();
        return view('backend.category.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {

        $category = Category::find($id);
        $category->categoryname = $request->categoryname;
        $category->created_at = date('Y-m-d H:i:s');
        if ($category->save()) {
            return redirect()->route('category.index')->with('successMsg', 'Sửa thành công');
        } else {
            return redirect()->route('category.index')->with('errorMsg', 'Không thể sửa ');
        }
    }


    public function destroy(string $id)
    {
        //
    }
}
