<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\DasboardController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CustomerController;
use App\Http\Controllers\backend\InvoiceController;
use App\Http\Controllers\backend\NewController;
use App\Http\Controllers\backend\OderController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SlideController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\fontend\HomeController;
use App\Http\Controllers\fontend\CartController;
use App\Http\Controllers\fontend\DetailsController;
use App\Http\Controllers\fontend\PrdController;
use App\Models\Invoice;

//home

   Route::get('/order', [CartController::class, 'order'])->name('layout.order');


Route::get('/prd', [PrdController::class, 'prd'])->name('layout.prd');
Route::post('cart/removeitem/{productId}', [CartController::class, 'removeItem'])->name('cart.removeItem');
Route::post('updatequantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/cart', [CartController::class, 'index'])->name('layout.cart');


Route::get('/details/{product}', [DetailsController::class, 'show'])->name('layout.details');
Route::get('/', [HomeController::class, 'index'])->name('layout.home');


//admin

Route::get('login', [CustomerController::class, 'login'])->name('layout.login');
Route::post('postlogin', [CustomerController::class, 'postlogin'])->name('layout.postlogin');
Route::middleware('auth.check')->group(function () {
   Route::post('/place-order', [CartController::class, 'placeOrder'])->name('placeOrder');
   Route::post('logout', [CustomerController::class,'logout'])->name('layout.logout');

   Route::prefix('admin')->group(function () {
      Route::get('/', [DasboardController::class, 'index'])->name('admin.dasboard');

      //invoice
      Route::prefix('invoice')->group(function () {
         Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
         Route::get('invoice/show/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');
         Route::post('xall', [InvoiceController::class, 'xall'])->name('invoice.xall');
      });

       //Oder
       Route::prefix('oder')->group(function () {
         Route::get('/', [OderController::class, 'index'])->name('oder.index');
         Route::get('update/{oder}', [OderController::class, 'edit'])->name('oder.edit');
         Route::post('update/{oder}', [OderController::class, 'update'])->name('oder.update');
      });

      //brand
      Route::prefix('brand')->group(function () {
         Route::get('/', [BrandController::class, 'index'])->name('brand.index');
         Route::get('delete/{brand}', [BrandController::class, 'delete'])->name('brand.delete');
         Route::get('create', [BrandController::class, 'create'])->name('brand.create');
         Route::post('store', [BrandController::class, 'store'])->name('brand.store');
         Route::post('xall', [BrandController::class, 'xall'])->name('brand.xall');
         Route::get('update/{brand}', [BrandController::class, 'edit'])->name('brand.edit');
         Route::post('update/{brand}', [BrandController::class, 'update'])->name('brand.update');
      });

      //category
      Route::prefix('category')->group(function () {
         Route::get('/', [CategoryController::class, 'index'])->name('category.index');
         Route::get('delete/{category}', [CategoryController::class, 'delete'])->name('category.delete');
         Route::get('create', [CategoryController::class, 'create'])->name('category.create');
         Route::post('store', [CategoryController::class, 'store'])->name('category.store');
         Route::post('xall', [CategoryController::class, 'xall'])->name('category.xall');
         Route::get('update/{category}', [CategoryController::class, 'edit'])->name('category.edit');
         Route::post('update/{category}', [CategoryController::class, 'update'])->name('category.update');
      });

      //product
      Route::prefix('product')->group(function () {
         Route::get('/', [ProductController::class, 'index'])->name('product.index');
         Route::get('show/{product}', [ProductController::class, 'show'])->name('product.show');
         Route::get('delete/{product}', [ProductController::class, 'delete'])->name('product.delete');
         Route::get('create', [ProductController::class, 'create'])->name('product.create');
         Route::post('store', [ProductController::class, 'store'])->name('product.store');
         Route::post('xall', [ProductController::class, 'xall'])->name('product.xall');
         Route::get('update/{product}', [ProductController::class, 'edit'])->name('product.edit');
         Route::post('update/{product}', [ProductController::class, 'update'])->name('product.update');
      });

      //role
      Route::prefix('role')->group(function () {
         Route::get('/', [RoleController::class, 'index'])->name('role.index');
         Route::get('delete/{role}', [RoleController::class, 'delete'])->name('role.delete');
         Route::get('create', [RoleController::class, 'create'])->name('role.create');
         Route::post('store', [RoleController::class, 'store'])->name('role.store');
         Route::post('xall', [RoleController::class, 'xall'])->name('role.xall');
         Route::get('update/{role}', [RoleController::class, 'edit'])->name('role.edit');
         Route::post('update/{role}', [RoleController::class, 'update'])->name('role.update');
      });

      //slide
      Route::prefix('slide')->group(function () {
         Route::get('/', [SlideController::class, 'index'])->name('slide.index');
         Route::get('delete/{slide}', [SlideController::class, 'delete'])->name('slide.delete');
         Route::get('create', [SlideController::class, 'create'])->name('slide.create');
         Route::post('store', [SlideController::class, 'store'])->name('slide.store');
         Route::post('xall', [SlideController::class, 'xall'])->name('slide.xall');
         Route::get('update/{slide}', [SlideController::class, 'edit'])->name('slide.edit');
         Route::post('update/{slide}', [SlideController::class, 'update'])->name('slide.update');
      });

      //customer
      Route::prefix('customer')->group(function () {
         Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
         Route::get('delete/{customer}', [CustomerController::class, 'delete'])->name('customer.delete');
         Route::get('show/{customer}', [CustomerController::class, 'show'])->name('customer.show');
         Route::get('create', [CustomerController::class, 'create'])->name('customer.create');
         Route::post('store', [CustomerController::class, 'store'])->name('customer.store');
         Route::post('xall', [CustomerController::class, 'xall'])->name('customer.xall');
         Route::get('update/{customer}', [CustomerController::class, 'edit'])->name('customer.edit');
         Route::post('update/{customer}', [CustomerController::class, 'update'])->name('customer.update');
      });

      //news
      Route::prefix('news')->group(function () {
         Route::get('/', [NewController::class, 'index'])->name('news.index');
         Route::get('delete/{news}', [NewController::class, 'delete'])->name('news.delete');
         Route::get('create', [NewController::class, 'create'])->name('news.create');
         Route::post('store', [NewController::class, 'store'])->name('news.store');
         Route::post('xall', [NewController::class, 'xall'])->name('news.xall');
         Route::get('update/{news}', [NewController::class, 'edit'])->name('news.edit');
         Route::post('update/{news}', [NewController::class, 'update'])->name('news.update');
      });
   });
});
