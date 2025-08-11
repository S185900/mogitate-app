@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css')}}">
@endsection

<!-- 商品登録画面 -->
<!-- http://localhost/products/register -->
@section('content')
<div class="register">
    <div class="register__inner">
    <div class="register__heading">
        <h2 class="register__heading-ttl">商品登録</h2>
    </div>
        <form id="product-form" class="register__inner__form" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data" novalidate>
            @csrf

            <!-- 商品名 -->
            <label class="register__inner-input" for="name">
                <h3 class="register__inner-input__ttl">商品名<span class="required-red-span">必須</span></h3>
                <div class="register__inner-input__input">
                    <input class="register__inner-input__input-submit" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="商品名を入力">
                </div>
            </label>

            <!-- 値段 -->
            <label class="register__inner-input" for="price">
                <h3 class="register__inner-input__ttl">値段<span class="required-red-span">必須</span></h3>
                <div class="register__inner-input__input">
                    <input class="register__inner-input__input-submit" type="text" name="price" id="price" value="{{ old('price') }}" placeholder="値段を入力">
                </div>
            </label>

            <!-- 商品画像 -->
            <div class="register__inner-select">
                <h3 class="register__inner-input__ttl">商品画像<span class="required-red-span">必須</span></h3>
                <div class="edit__inner__grid-fruit-img">
                    <!-- ファイルがstorageに一時保存されたらプレビュー表示、されなければ何も表示しない -->
                    @if (session('temporaryFile'))
                        <img src="{{ asset('storage/' . session('temporaryFile')) }}" alt="プレビュー画像">
                    @endif
                </div>
                <div class="edit__inner__file-select">
                    <label class="register__inner-input__file" id="image" type="button">
                        <input class="register__inner-input__file-submit" type="file" name="image" id="image" accept="image/*">
                        ファイルを選択
                    </label>
                    <div class="edit__inner-input__file-name">
                        <p>
                            @if (!empty($temporaryFile))
                                {{ pathinfo($temporaryFile, PATHINFO_FILENAME) }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>


            <!-- 季節 -->
            <div class="register__inner-input">
                <h3 class="register__inner-input__ttl">
                    季節
                    <span class="required-red-span">必須</span>
                    <span class="required-red-text">複数選択可</span>
                </h3>
                <div class="register__inner-input__checkbox">
                    @foreach(['春' => 1, '夏' => 2, '秋' => 3, '冬' => 4] as $label => $value)
                        <input type="checkbox" id="checkbox{{ $value }}" name="season[]" value="{{ $value }}">
                        <label for="checkbox{{ $value }}" class="season1">{{ $label }}</label>
                    @endforeach
                </div>
            </div>

            <!-- 商品説明 -->
            <label class="register__inner-textarea" for="description">
                <h3 class="register__inner-input__ttl">商品説明<span class="required-red-span">必須</span></h3>
                <textarea class="register__inner-input__textarea" id="description" name="description" rows="6" cols="30" placeholder="例）爽やかな香りと上品な甘みが特長的なキウイは大人から子どもまで大人気のフルーツです。疲れた脳や体のエネルギー補給にも最適の商品です。もぎたてフルーツのスムージーをお召し上がりください！">{{ old('description') }}</textarea>
            </label>

            <!-- ボタン -->
            <div class="register__inner-btn">
                <button class="register__inner__btn-submit btn-gray" type="button" onclick="location.href='/products';" id="btn-back" value="">戻る</button>
                <button form="product-form" class="register__inner__btn-submit btn-yellow" type="submit" id="btn-submit" value="">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection

