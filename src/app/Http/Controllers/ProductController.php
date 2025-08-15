<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
    // 商品一覧ページ
    // ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
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

    // 商品一覧ページ：商品カードをクリックすると商品詳細画面へ遷移(ルート：edit)
    public function edit($productId)
    {
        // 選択されていない季節のチェックボックスも表示させるため、4つ全ての季節情報を取得
        $allSeasons = Season::all();
        $product = Product::with('seasons')->findOrFail($productId);

        // 一覧画面から詳細画面への受け渡し
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


    // ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
    // 商品詳細ページ. // 商品情報更新の時はsyncを使う？
    // ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝


    // 画像ファイル再選択：セッションに画像のパスが格納され、次回リクエスト時にプレビュー表示
    public function uploadTemporaryImage(Request $request)
    {
        $path = $request->file('image')->store('temp_images'); // 一時保存ディレクトリ
        session(['temporary_image_path' => $path]); // セッションに保存

        return redirect()->back();
    }

    // 商品のデータベース更新
    public function update(UpdateProductRequest $request, $productId)
    {

        // バリデーション済みデータを取得
        $validatedData = $request->validated();

        // 商品情報の取得
        $product = Product::findOrFail($productId);

        // 新しい画像がアップロードされた場合の処理
        if ($request->hasFile('image')) {
            $file = $request->file('image');
                $fileName = date('Y-m-d_H:i:s') . '_' . $file->getClientOriginalName(); // 重複回避
                $storedFilePath = $file->storeAs('public', $fileName); // storageに保存
                $validatedData['image'] = str_replace('public', 'storage', $storedFilePath); // 公開パスに変換
            } else {
                // 画像がアップロードされていない場合は既存の画像パスを保持
                $validatedData['image'] = $product->image;
            }

        // 商品情報を更新
        $product->update([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'], // 画像パス更新または保持の値がimageに入っている
        ]);

        // 季節データの更新（配列形式で受け取り）
        $product->seasons()->sync($request->input('season', []));

        // セッション削除
        session()->forget('temporary_image_path');

        // 更新後にリダイレクト
        return redirect()->route('products.index', ['productId' => $product->id]);

    }

    // ゴミ箱ボタン（削除）
    public function destroy($productId)
    {

        // 商品情報を取得
        $product = Product::findOrFail($productId);

        // 商品を削除
        $product->delete();

        // 削除後に一覧画面へリダイレクト
        return redirect()->route('products.index');

    }


    // ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
    // 商品登録ページ
    // ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
    public function showRegisterForm()
    {
        session()->forget('temporaryFile'); // セッションデータを削除
        return view('create');
    }

    // 商品登録（ルート：products.store）
    public function store(StoreProductRequest $request)
    {
        // dd($request->all());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = date('Y-m-d_H:i:s') . '_' . $file->getClientOriginalName(); // 重複回避
            $storedFilePath = $file->storeAs('public', $fileName); // storageに保存
            $request->merge(['image' => str_replace('public', 'storage', $storedFilePath)]); // 公開パスに変換
            // $storedFilePath = $file->storeAs('public/temporary', $fileName); // 一時保存ディレクトリ
            // session()->put(['temporaryFile' => asset('storage/', $storedFilePath)]); // セッションに保存
            // session()->put(['temporaryFile' => str_replace('public', 'storage', $storedFilePath)]);
            session()->put(['temporaryFile' => $this->convertStoragePath($storedFilePath)]); // セッションに保存
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

        return redirect()->route('products.store');
        // dd(session()->all());
    }


    // session強制的にstorage/ファイル名へ変更
    public function convertStoragePath($storedFilePath) {
        return str_replace('public', 'storage', $storedFilePath);

    }


}