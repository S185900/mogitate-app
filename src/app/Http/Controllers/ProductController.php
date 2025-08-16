<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // 商品詳細ページ：商品情報の編集・更新
    public function update(UpdateProductRequest $request, $productId)
    {
        $validatedData = $request->validated();
        $product = Product::findOrFail($productId);

        // 新しく画像がアップロードされた場合の処理
        if ($request->hasFile('image')) {
            $file = $request->file('image');
                $fileName = date('Y-m-d_H:i:s') . '_' . $file->getClientOriginalName();
                $storedFilePath = $file->storeAs('public', $fileName);
                $validatedData['image'] = str_replace('public', 'storage', $storedFilePath);
            } else {
                $validatedData['image'] = $product->image;
            }

        $product->update([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
        ]);

        $product->seasons()->sync($request->input('season', []));
        session()->forget('temporary_image_path');
        return redirect()->route('products.index', ['productId' => $product->id]);
    }

    // 商品詳細ページ：商品情報の削除
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();
        return redirect()->route('products.index');
    }

    // 商品登録ページ：トップ
    public function showRegisterForm()
    {
        session()->forget('temporaryFile');
        return view('create');
    }

    // 商品登録ページ：商品情報の新規登録
    public function store(StoreProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = date('Y-m-d_H:i:s') . '_' . $file->getClientOriginalName();
            $storedFilePath = $file->storeAs('public', $fileName);
            $request->merge(['image' => str_replace('public', 'storage', $storedFilePath)]);
            session()->put(['temporaryFile' => $this->convertStoragePath($storedFilePath)]);
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
    }

    // sessionでの画像プレビュー表示用：「public/ファイル名」を「storage/ファイル名」へ変更
    public function convertStoragePath($storedFilePath) {
        return str_replace('public', 'storage', $storedFilePath);
    }

}