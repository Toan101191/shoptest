<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class NewController extends Controller
{
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function index()
    {
        $list_new = News::with('customer')->get();
        return view('backend.news.index', compact('list_new'));
    }

    public function xall(Request $request)

    {
        foreach ($request->gen as $item) {
            $new = News::where('id', '=', $item);
            $new->delete();
        }
        return redirect()->route('news.index')->with('successMsg', 'Xóa tất cả tin tức thành công');
    }
    
    public function create()
    {
        $new = new News();
        return view('backend.news.create', compact('new'));
    }

   
    public function store(Request $request)
    {
        $new = new News;
        $new->newtitle = $request->newtitle;
        $new->slug = Str::slug($new->newtitle = $request->newtitle, '-');
        $new->image = $request->image;
        $new->newcontent = $request->newcontent;
        $new->customer_id = $request->customer_id;
        $new->cat_new = $request->cat_new;
        $new->created_at = date('Y-m-d H:i:s');
        if ($request->has('image')) {
            $past_dir = "img/product/";
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $new->slug . '.' . $extension;
            $file->move($past_dir, $filename);
            $new->image = $filename;
        }

        if ($new->save()) {
            return redirect()->route('news.index')->with('successMsg', 'Thêm thành công');
        } else {
            return redirect()->route('news.index')->with('errorMsg', 'Không thể thêm');
        }
    }

    public function delete(Request $request, $id)
    {

        $new = News::find($id);
        $past_dir = "img/product/";
        $path_image_delete = public_path($past_dir . $new->image);
        if ($new == null) {
            return redirect()->route('new.index')->with('message', ['type' => 'danger', 'msg' => 'Không thể thay đổi trạng thái']);
        } else {
            if ($new->delete()) {
                if (File::exists($path_image_delete)) {
                    File::delete($path_image_delete);
                }
                $file = $request->file('image');
                if ($file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = $new->slug . '.' . $extension;
                    $file->move($past_dir, $filename);
                    $new->image = $filename;
                }
                return redirect()->route('customer.index')->with('successMsg', 'Xóa thành công');
            }
        }
    }


    public function show(string $id)
    {
        
    }

    
    public function edit($id)
    {
        $new = News::find($id);
        // $new = new::orderby('created_at','desc')->first();
        return view('backend.news.edit', compact('new'));
    }


    public function update(Request $request, $id)
    {
        $new = News::find($id);
        $new->newtitle = $request->newtitle;
        $new->slug = Str::slug($new->newtitle = $request->newtitle, '-');
        $new->newcontent = $request->newcontent;
        $new->customer_id = $request->customer_id;
        $new->cat_new = $request->cat_new;
        $new->created_at = date('Y-m-d H:i:s');

        if ($request->hasFile('image')) {
            // Delete the old image file
            if (File::exists($new->image)) {
                File::delete($new->image);
            }

            // Save the new image file
            $past_dir = "img/product/";
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $new->slug . '.' . $extension;
            $file->move($past_dir, $filename);
            $new->image = $filename;
        }

        // Giữ lại giá trị cũ nếu không có tệp tin mới được chọn
        if (!$request->hasFile('image') && $new->image) {
            $new->image = $new->getOriginal('image');
        }

        if ($new->save()) {
            return redirect()->route('news.index')->with('successMsg', 'Sửa thành công');
        } else {
            return redirect()->route('news.index')->with('errorMsg', 'Không thể sửa');
        }
    }


   
    public function destroy(string $id)
    {
        
    }
}
