<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Season;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\IndexController;


// 商品登録ページ：トップ
Route::get('/products/register', [ProductController::class, 'showRegisterForm'])->name('products.register');

// 商品登録ページ：商品登録後、商品一覧ページへ遷移
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// 商品登録ページ：入力してデータベースに保存
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// 商品一覧ページ：トップ
Route::get('/products', [IndexController::class, 'index'])->name('products.index');

// 商品一覧ページ：商品名、high or lowで検索後、商品一覧ページへ遷移
Route::get('/products/search', [IndexController::class, 'search'])->name('products.search');

// 商品一覧ページ：商品カードをクリックすると商品詳細ページへ遷移
Route::get('/products/{productId}', [IndexController::class, 'edit'])->name('products.edit');

// 商品詳細ページ：データ更新後、商品一覧ページへ遷移
Route::patch('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');

// 商品詳細ページ：データ削除後、商品一覧ページへ遷移
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.destroy');