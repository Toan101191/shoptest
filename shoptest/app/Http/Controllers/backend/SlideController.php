<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class SlideController extends Controller
{

    public function index()
    {

        $list_slide = Slide::get();
        return view('backend.slide.index', compact('list_slide'));
    }

    public function xall(Request $request)

    {
        foreach ($request->gen as $item) {
            $slide = Slide::where('id', '=', $item);
            $slide->delete();
        }
        return redirect()->route('slide.index')->with('successMsg', 'Xóa tất cả danh mục sản phẩm thành công');
    }
    public function create()
    {
        return view('backend.slide.create');
    }

    public function store(Request $request)
    {

        $slide = new Slide;
        $slide->slidetitle = $request->slidetitle;
        $slide->slug = Str::slug($slide->slidetitle = $request->slidetitle, '-');
        $slide->slide_image = $request->slide_image;
        $slide->created_at = date('Y-m-d H:i:s');
        if ($request->has('slide_image')) {
            $past_dir = "img/product/";
            $file = $request->file('slide_image');
            $extension = $file->getClientOriginalExtension();
            $filename = $slide->slug . '.' . $extension;
            $file->move($past_dir, $filename);
            $slide->slide_image = $filename;
        }

        if ($slide->save()) {
            return redirect()->route('slide.index')->with('successMsg', 'Thêm thành công');
        } else {
            return redirect()->route('slide.index')->with('errorMsg', 'Không thể thêm');
        }
    }
    public function delete($id)
    {
        $slide = Slide::find($id);
        if ($slide == null) {
            return redirect()->route('slide.index')->with('message', ['type' => 'success', 'msg'
            => 'Không tồn tại']);
        } else {
            $slide->delete();
            return redirect()->route('slide.index')->with('successMsg', 'Xoá thành công ');
        }
    }

    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {
        $slide = Slide::find($id);
        // $slide = slide::orderby('created_at','desc')->first();
        return view('backend.slide.edit', compact('slide'));
    }


    public function update(Request $request, $id)
{
    $slide = Slide::find($id);
    $slide->slidetitle = $request->slidetitle;
    $slide->slug = Str::slug($slide->slidetitle, '-');
    $slide->created_at = date('Y-m-d H:i:s');

    if ($request->hasFile('slide_image')) {
        // Delete the old image file
        if (File::exists($slide->slide_image)) {
            File::delete($slide->slide_image);
        }
        
        // Save the new image file
        $past_dir = "img/product/";
        $file = $request->file('slide_image');
        $extension = $file->getClientOriginalExtension();
        $filename = $slide->slug . '.' . $extension;
        $file->move($past_dir, $filename);
        $slide->slide_image = $filename;
    }

    if ($slide->save()) {
        return redirect()->route('slide.index')->with('successMsg', 'Sửa thành công');
    } else {
        return redirect()->route('slide.index')->with('errorMsg', 'Không thể sửa');
    }
}



    public function destroy(string $id)
    {
        //
    }
}
