<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Season;
use App\Http\Controllers\ProductController;


// 商品登録ページ表示のみ
Route::get('/products/register', [ProductController::class, 'showRegisterForm'])->name('products.register');

// 商品登録ページ：ファイルを選択ボタン→画像ファイルをプレビュー表示
Route::post('/image/upload', [ProductController::class, 'storeTemporaryFile'])->name('image.upload');

// 商品登録ページ：入力してデータベースに保存
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// 商品一覧ページ表示のみ ｜ 商品登録後→商品一覧ページへ遷移
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// 商品一覧ページ:商品検索→一覧ページへ遷移
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

// 商品カードをクリックすると商品詳細ページへ遷移
Route::get('/products/{productId}', [ProductController::class, 'edit'])->name('products.edit');

// 商品詳細ページ：ファイルを選択ボタン→画像ファイルをプレビュー表示
Route::post('/products/{productId}', [ProductController::class, 'fileUpdate'])->name('file.update');

// 商品更新ページ
// ルーティングは　/products/{productId}/update



// // 商品詳細ページ
// Route::get('/products/{productId}', function () {
//     return view('edit');
// });