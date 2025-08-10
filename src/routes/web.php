<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Season;
use App\Http\Controllers\ProductController;

// // 商品登録ページ
// Route::get('/products/register', function () {
//     return view('register');
// });

// 商品登録ページ
Route::get('/products/register', function () {
    return view('create');
});

// 商品一覧ページ
Route::get('/products', [ProductController::class, 'index']);

// 商品カードをクリックすると商品詳細画面へ遷移
Route::get('/products/{id}', [ProductController::class, 'edit'])->name('edit');





// // 商品詳細ページ
// Route::get('/products/{productId}', function () {
//     return view('edit');
// });