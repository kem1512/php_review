<?php

use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('components.front.main');
});

Route::get('/admin/brand', [BrandController::class, 'index']);
Route::post('/admin/brand', [BrandController::class, 'store']);
Route::delete('/admin/brand/{id}', [BrandController::class, 'destroy']);
Route::get('/admin/brand/update/{id}', [BrandController::class, 'show']);
Route::post('/admin/brand/update/{id}', [BrandController::class, 'update ']);

Route::get('/shop', function () {
    $products = Product::with('productDetails')->with('productImages')->paginate(9);
    $productDetails = ProductDetail::all();
    $tags = Product::select('tag')->distinct()->get();
    $categories = Category::with('products')->get();
    $brands = Brand::with('products')->get();
    return view('components.front.shop')->with(compact('products', 'categories', 'brands', 'tags', 'productDetails'));
});
