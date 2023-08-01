<?php

namespace App\Http\Controllers\fontend;

use App\Models\Oder;
use App\Models\Invoice;
use App\Models\Invoice_details;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

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
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $imgproduct = $product->imgproduct;
        $quantity = $request->input('quantity', 1); // Lấy số lượng từ request (nếu không có, mặc định là 1)

        // Lấy giỏ hàng từ Cookie (nếu có)
        $cart = Cookie::has('cart') ? json_decode(Cookie::get('cart'), true) : [];

        if (isset($cart[$id])) {
            // Sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên $quantity
            $cart[$id]['quantity'] += $quantity;
        } else {
            // Sản phẩm chưa tồn tại trong giỏ hàng, thêm mới với số lượng là $quantity
            $cart[$id] = [
                'quantity' => $quantity,
                'imgproduct' => $imgproduct
            ];
        }

        Cookie::queue('cart', json_encode($cart), 60); // Lưu giỏ hàng trong Cookie

        return response()->json(['success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng']);
    }
    public function removeItem($productId)
    {
        // Lấy giỏ hàng từ Cookie (nếu có)
        $cart = Cookie::has('cart') ? json_decode(Cookie::get('cart'), true) : [];

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
    public function order()
    {
        $orderTime = Carbon::now('Asia/Ho_Chi_Minh'); // Lấy thời gian hiện tại theo múi giờ của Hồ Chí Minh

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
        return view('layout.order', compact('list_brand', 'list_category', 'cartItems', 'orderTime'));
    }
    public function placeOrder(Request $request)
    {
        // Lấy dữ liệu từ request
        $customer_id = $request->input('customer_id');
        $note = $request->input('note');
        $total = $request->input('total');
        $totalValue = $request->input('total');
        $totalValue = str_replace(['.', ',', 'VND'], '', $totalValue); // Loại bỏ dấu chấm, dấu phẩy và chữ "VND"
        $total = floatval($totalValue); // Chuyển đổi thành số thập phân

        // Tạo đối tượng Invoice và lưu vào bảng invoice
        $invoice = new Invoice();
        $invoice->orderdate = Carbon::now()->toDateTimeString(); // Chuyển đổi thành chuỗi định dạng có thể lưu vào cơ sở dữ liệu
        $invoice->customer_id = $customer_id;
        $invoice->total = $total;
        $invoice->save();

        // Lưu thông tin chi tiết đơn hàng vào bảng invoice_details
        foreach ($request->input('product_id') as $productId) {
            $quantity = $request->input('quantity_' . $productId);

            $invoiceDetail = new Invoice_details();
            $invoiceDetail->invoice_id = $invoice->id; // Lưu id của invoice mới tạo vào invoice_details
            $invoiceDetail->product_id = $productId;
            $invoiceDetail->quantity = $quantity;
            $invoiceDetail->save();
        }
        // Tạo đối tượng Order và lưu vào bảng order
        $order = new Oder();
        $order->orderdate = Carbon::now()->toDateTimeString(); // Chuyển đổi thành chuỗi định dạng có thể lưu vào cơ sở dữ liệu
        $order->customer_id = $customer_id;
        $order->invoice_id = $invoice->id; // Lưu id của invoice mới tạo vào order
        $order->note = $note;
        $order->total = $total;
        $order->save();
        // Xoá toàn bộ thông tin trong giỏ hàng
        Cookie::queue(Cookie::forget('cart'));    
        // Hiển thị thông báo đặt hàng thành công và trở về trang home
        return redirect()->route('layout.home')->with('success', 'Đặt hàng thành công');
    }
}
