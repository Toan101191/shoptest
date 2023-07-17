<?php

namespace App\Http\Controllers\fontend;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Slide;
use App\Models\Category;
use App\Models\News;

class CartController extends Controller
{
    // ...

    public function index()
    {
        $list_brand = Brand::get();
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

        return view('layout.cart', compact('list_brand', 'list_category', 'cartItems'));
    }
    public function addToCart($id)
{
    $product = Product::findOrFail($id);
    $imgproduct = $product->imgproduct;

    // Lấy giỏ hàng từ Cookie (nếu có)
    $cart = Cookie::has('cart') ? json_decode(Cookie::get('cart'), true) : [];

    if (isset($cart[$id])) {
        // Sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên 1
        $cart[$id]['quantity']++;
    } else {
        // Sản phẩm chưa tồn tại trong giỏ hàng, thêm mới với số lượng là 1
        $cart[$id] = [
            'quantity' => 1,
            'imgproduct' => $imgproduct
        ];
    }

    Cookie::queue('cart', json_encode($cart), 60); // Lưu giỏ hàng trong Cookie

    return redirect()->back(); // Chuyển hướng ngược trở lại trang trước đó
}

    
    public function removeItem($productId)
    {
        // Lấy giỏ hàng từ Cookie
        $cart = [];
        if (Cookie::has('cart')) {
            $cart = json_decode(Cookie::get('cart'), true);
        }
    
        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng hay không
        if (isset($cart[$productId])) {
            // Xoá sản phẩm khỏi giỏ hàng
            unset($cart[$productId]);
    
            // Cập nhật lại Cookie giỏ hàng hoặc xoá Cookie nếu giỏ hàng trống
            if (empty($cart)) {
                Cookie::queue(Cookie::forget('cart'));
            } else {
                Cookie::queue('cart', json_encode($cart), 60);
            }
    
            // Gửi thông báo thành công (nếu cần)
            return response()->json(['success' => true, 'message' => 'Xoá sản phẩm khỏi giỏ hàng thành công']);
        } else {
            // Gửi thông báo lỗi (nếu cần)
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm trong giỏ hàng']);
        }
    }
    

    
}
