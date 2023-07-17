<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
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
        $searchTerm = $request->input('search');
        $list_product = Product::where(function ($query) use ($searchTerm) {
            $query->where('productname', 'LIKE', '%' . $searchTerm . '%');
        })->take(8)->get();
        $searched = $searchTerm !== null && $searchTerm !== '';
        $latestProducts = Product::orderBy('created_at', 'desc')->take(6)->get();
        $latestOutstandingProducts = Product::where('outstanding', 1)->orderBy('created_at', 'desc')->take(6)->get();
        $randomProducts = Product::inRandomOrder()->take(6)->get();
        return view('layout.home', compact('list_product', 'searched',
         'latestProducts', 'latestOutstandingProducts', 'randomProducts',
          'list_category', 'list_brand', 'list_slide', 'list_category', 'list_new'));
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
