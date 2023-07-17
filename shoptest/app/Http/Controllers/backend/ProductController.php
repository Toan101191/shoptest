<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brandid');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function index(Request $request)
    {
        $query = Product::query();

        $list_brand = Brand::get();
        $list_category = Category::get();
        $searchTerm = $request->input('search');

        if ($searchTerm) {
            $query->where('productname', 'LIKE', '%' . $searchTerm . '%');
        }

        $list_product = $query->paginate(4);
        $searched = $searchTerm !== null && $searchTerm !== '';

        return view('backend.product.index', compact('list_product', 'searched', 'list_brand', 'list_category'));
    }

    public function create()
    {
        $list_brand = Brand::get();
        $list_category = Category::get();
        $product = new Product; // Tạo đối tượng Product mới
        // Truyền biến $product vào view
        return view('backend.product.create', compact('product', 'list_brand', 'list_category'));
    }
    public function delete(Request $request, $id)
    {

        $product = Product::find($id);
        $past_dir = "img/product/";
        $path_image_delete = public_path($past_dir . $product->imgproduct);
        if ($product == null) {
            return redirect()->route('product.index')->with('message', ['type' => 'danger', 'msg' => 'Không thể thay đổi trạng thái']);
        } else {
            if ($product->delete()) {
                if (File::exists($path_image_delete)) {
                    File::delete($path_image_delete);
                }
                $file = $request->file('imgproduct');
                if ($file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = $product->slug . '.' . $extension;
                    $file->move($past_dir, $filename);
                    $product->imgproduct = $filename;
                }
                return redirect()->route('product.index')->with('successMsg', 'Xóa thành công');
            }
        }
    }

    public function store(Request $request)
    {
        $product = new Product;
        $product->productname = $request->productname;
        $product->slug = Str::slug($product->productname = $request->productname, '-');
        $product->brandid = $request->brandid;
        $product->category_id = $request->category_id;
        $product->human = $request->human;
        $product->imgproduct = $request->imgproduct;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->outstanding = $request->outstanding;
        $product->created_at = date('Y-m-d H:i:s');
        if ($request->has('imgproduct')) {
            $past_dir = "img/product/";
            $file = $request->file('imgproduct');
            $extension = $file->getClientOriginalExtension();
            $filename = $product->slug . '.' . $extension;
            $file->move($past_dir, $filename);
            $product->imgproduct = $filename;
        }

        if ($product->save()) {
            return redirect()->route('product.index')->with('successMsg', 'Thêm thành công');
        } else {
            return redirect()->route('product.index')->with('errorMsg', 'Không thể thêm ');
        }
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.product.show', compact('product'));
    }

    public function xall(Request $request)

    {
        foreach ($request->gen as $item) {
            $product = Product::where('id', '=', $item);
            $product->delete();
        }
        return redirect()->route('product.index')->with('successMsg', 'Xóa tất cả sản phẩm thành công');
    }
    public function edit($id)
    {
        $list_brand = Brand::get();
        $list_category = Category::get();
        $product = Product::find($id);
        return view('backend.product.edit', compact('product', 'list_brand', 'list_category'));
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->productname = $request->productname;
        $product->slug = Str::slug($product->productname, '-');
        $product->brandid = $request->brandid;
        $product->category_id = $request->category_id;
        $product->human = $request->human;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->outstanding = $request->outstanding;
        $product->created_at = date('Y-m-d H:i:s');

        // Check if a new image file is uploaded
        if ($request->hasFile('imgproduct')) {
            // Delete the old image file
            if (File::exists($product->imgproduct)) {
                File::delete($product->imgproduct);
            }

            // Save the new image file
            $past_dir = "img/product/";
            $file = $request->file('imgproduct');
            $extension = $file->getClientOriginalExtension();
            $filename = $product->slug . '.' . $extension;
            $file->move($past_dir, $filename);
            $product->imgproduct = $filename;
        }

        if ($product->save()) {
            return redirect()->route('product.index')->with('successMsg', 'Sửa thành công');
        } else {
            return redirect()->route('product.index')->with('errorMsg', 'Không thể sửa');
        }
    }


    public function destroy(string $id)
    {
        //
    }
}
