<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 商品一覧ページ表示
    public function index()
    {
        $products = Product::paginate(6);
        return view('index', compact('products'));
    }

    // 商品一覧ページ：商品名で検索のアクション
    public function search(Request $request)
    {
        $sort = $request->query('sort', 'default');
        $query = Product::query();

        // 商品名で検索
        if ($request->filled('name') && $request->name !== '商品名で検索') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'low') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6);

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

    // 商品カードをクリックすると商品詳細画面へ遷移(ルート：edit)
    public function edit($productId)
    {
        // 選択されていない季節のチェックボックスも表示させるため、4つ全ての季節情報を取得
        $allSeasons = Season::all();
        $product = Product::with('seasons')->findOrFail($productId);

        // 一覧画面から詳細画面への受け渡し
        return view('edit', [
            'product' => $product,
            'seasons' => $product->seasons,
            'description' => $product->description,
            'image' => $product->image,
            'price' => $product->price,
            'name' => $product->name,
            'allSeasons' => $allSeasons
        ]);
    }

    // ファイルプレビュー表示用(ルート：file.update/ファイル選択時の<input>ボタンに実装)
    public function fileUpdate(Request $request, $productId)
    {
        $uploadedFileField = 'image'; //HTMLの<input>name="image"と統一
        $temporaryFile = null;

        if ($request->hasFile($uploadedFileField)) {
            $file = $request->file($uploadedFileField);
            $fileName = date('Y-m-d') . '_' . $file->getClientOriginalName(); // ファイル名作成(重複回避)
            $storedFilePath = $file->storeAs('public', $fileName); // storageにファイル保存
            $temporaryFile = str_replace('public', 'storage', $storedFilePath); // 公開パスに変換
        }

        $product = Product::findOrFail($productId);

        $allSeasons = Season::all();
        $product = Product::with('seasons')->findOrFail($productId);

        return view('edit', [
            'product' => $product,
            'temporaryFile' => $temporaryFile, // 保存されたファイルのパス
            'image' => $product->image, // 既存の画像パス
            'seasons' => $product->seasons,
            'description' => $product->description,
            'image' => $product->image,
            'price' => $product->price,
            'name' => $product->name,
            'allSeasons' => $allSeasons,
        ]);
    }

    // 商品情報更新の時はsyncを使う？



    // 商品登録ページ表示のみ
    public function showRegisterForm()
    {
        session()->forget('temporaryFile'); // セッションデータを削除
        return view('create');
    }

    // ファイルプレビュー表示用
    public function storeTemporaryFile(Request $request)
    {

        $file = $request->file('image');
        dd($file);
        if ($file) {
            $fileName = date('Y-m-d_H:i:s') . '_' . $file->getClientOriginalName(); // 重複回避
            $storedFilePath = $file->storeAs('public/temp', $fileName); // storageにファイル保存
            dd($storedFilePath);
            session(['temporaryFile' => str_replace('public', 'storage', $storedFilePath)]); // 公開パスに変換
            return back();
        }
    }

    // 商品登録（ルート：products.store）
    public function store(Request $request)
    {
        // dd($request->all());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = date('Y-m-d_H:i:s') . '_' . $file->getClientOriginalName(); // 重複回避
            $storedFilePath = $file->storeAs('public', $fileName); // storageに保存
            $request->merge(['image' => str_replace('public', 'storage', $storedFilePath)]); // 公開パスに変換
        }

        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $request->input('image'),
        ]);

        if ($request->has('season')) {
            $product->seasons()->attach($request->input('season'));
        }

        return redirect()->route('products.index');
    }






}
