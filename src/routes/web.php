<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Season;
use App\Http\Controllers\ProductController;


// 商品一覧ページ
Route::get('/products', function () {
    $product = Product::paginate(6);
    return view('index', compact('product'));
});

// 商品登録ページ
Route::get('/products/register', function () {
    return view('create');
});

// 商品詳細ページ
Route::get('/products/{productId}', function () {
    return view('edit');
});