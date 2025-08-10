<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 商品一覧ページ
    public function index()
    {
        $products = Product::paginate(6);
        return view('index', compact('products'));
    }

    // 高い順・低い順でソート検索・並び替え時のアクション
    public function sortedIndex(Request $request)
    {
        $query = Product::query();

        if ($request->has('sort') && $request->sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->has('sort') && $request->sort === 'low') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6);

        return view('index', compact('products'));
    }

    // 商品カードをクリックすると商品詳細画面へ遷移
    public function edit($id)
    {

        $allSeasons = Season::all();

        $product = Product::with('seasons')->findOrFail($id);

        return view('edit', [
        'product' => $product,
        'seasons' => $product->seasons,
        'description' => $product->description,
        'image' => $product->image,
        'price' => $product->price,
        'name' => $product->name,
        'allSeasons' => $allSeasons
        ]);

        return view('edit', compact('product'));
    }


    // 商品登録
    






}
