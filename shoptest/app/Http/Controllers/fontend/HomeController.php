<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use App\Models\Customer;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Brand;
use App\Models\Slide;
use App\Models\Category;
use App\Models\News;

class HomeController extends Controller
{
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brandid');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function customer()
    {
        return $this->belongsTo(Slide::class, 'customer_id');
    }
    public function index(Request $request)
    {
        $list_brand = Brand::get();
        $list_new = News::latest()->take(3)->get();
        $list_slide = Slide::get();
        $list_category = Category::get();

        $cartItems = [];

        if (Cookie::has('cart')) {
            $cart = json_decode(Cookie::get('cart'), true);

            foreach ($cart as $productId => $item) {
                $product = Product::findOrFail($productId);
                $quantity = $item['quantity'];
                $price = $product->price;
                // Kiểm tra tồn tại của 'imgproduct'
                $imgproduct = isset($item['imgproduct']) ? $item['imgproduct'] : 'default-image.jpg';
                $total = $price * $quantity;

                $cartItems[] = [
                    'productId' => $productId,
                    'product' => $product,
                    'quantity' => $quantity,
                    'imgproduct' => $imgproduct,
                    'price' => $price,
                    'total' => $total
                ];
            }
        }
        $searchTerm = $request->input('search');
        $list_product = Product::where(function ($query) use ($searchTerm) {
            $query->where('productname', 'LIKE', '%' . $searchTerm . '%');
        })->take(8)->get();
        $searched = $searchTerm !== null && $searchTerm !== '';
        $latestProducts = Product::orderBy('created_at', 'desc')->take(6)->get();
        $latestOutstandingProducts = Product::where('outstanding', 1)->orderBy('created_at', 'desc')->take(6)->get();
        $randomProducts = Product::inRandomOrder()->take(6)->get();
        return view('layout.home', compact(
            'list_product',
            'searched',
            'latestProducts',
            'latestOutstandingProducts',
            'randomProducts',
            'list_category',
            'list_brand',
            'list_slide',
            'list_category',
            'list_new',
            'cartItems'
        ));
    }

}
