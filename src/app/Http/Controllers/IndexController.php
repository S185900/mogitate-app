<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // 商品一覧ページ：トップ
    public function index()
    {
        $products = Product::paginate(6);
        return view('index', compact('products'));
    }

    // 商品一覧ページ：商品名、high or lowで検索
    public function search(Request $request)
    {
        $sort = $request->query('sort', 'default');
        $query = Product::query();

        // 商品名で検索
        if ($request->filled('name') && $request->name !== '商品名で検索') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // high or lowで検索
        if ($sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'low') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6);
        return view('index', compact('products'));
    }

    // 商品一覧ページ：商品カードをクリックすると商品詳細ページへ遷移
    public function edit($productId)
    {
        $allSeasons = Season::all();
        $product = Product::with('seasons')->findOrFail($productId);

        // 一覧画面から詳細画面へのデータ受け渡し
        return view('edit', [
            'productId' => $product->id,
            'product' => $product,
            'seasons' => $product->seasons,
            'description' => $product->description,
            'image' => $product->image,
            'price' => $product->price,
            'name' => $product->name,
            'allSeasons' => $allSeasons
        ]);
    }
}
