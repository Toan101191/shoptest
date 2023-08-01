<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Slide;
use Illuminate\Support\Facades\Cookie;
use App\Models\Category;

class DetailsController extends Controller
{

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $list_brand = Brand::get();
        $list_category = Category::get();
        $cartItems = [];

        if (Cookie::has('cart')) {
            $cart = json_decode(Cookie::get('cart'), true);

            foreach ($cart as $productId => $item) {
                
                $cartProduct = Product::findOrFail($productId);
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

        $productsSameBrand = Product::where('brandid', $product->brandid)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
        
        // Lấy sản phẩm cùng category
        $productsSameCategory = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('layout.details', compact('product', 'list_brand', 'list_category', 'cartItems', 'productsSameBrand', 'productsSameCategory'));
    }

  
}
