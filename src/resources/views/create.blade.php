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
            <div class="register__inner-input">
                <h3 class="register__inner-input__ttl">商品名<span class="required-red-span">必須</span></h3>
                <label class="register__inner-input__input" for="name-product">
                    <input class="register__inner-input__input-submit" type="text" name="name" id="name-product" value="{{ old('name') }}" placeholder="商品名を入力">
                </label>
                @if ($errors->has('name'))
                <div class="error-message__name">
                    <span>{{ $errors->first('name') }}</span>
                </div>
                @endif
            </div>

            <!-- 値段 -->
            <div class="register__inner-input">
                <h3 class="register__inner-input__ttl">値段<span class="required-red-span">必須</span></h3>
                <label class="register__inner-input__input" for="price-product">
                    <input class="register__inner-input__input-submit" type="text" name="price" id="price-product" value="{{ old('price') }}" placeholder="値段を入力">
                </label>
                @if ($errors->has('price'))
                    <div class="error-message__price">
                        <span>{{ $errors->first('price') }}</span>
                    </div>
                @endif
            </div>

            <!-- 商品画像 -->
            <div class="register__inner-select">
                <h3 class="register__inner-input__ttl">商品画像<span class="required-red-span">必須</span></h3>
                <div class="edit__inner__grid-fruit-img">

                    <!-- ファイルがstorageに一時保存されたらプレビュー表示、されなければ何も表示しない -->
                    @if (session('temporaryFile'))
                        <img src="{{ asset(session('temporaryFile')) }}" alt="選択したファイル">
                    @endif

                </div>

                <div class="edit__inner__file-select">
                    <!-- 別ビューをinclude -->
                    <iframe name="iframe-upload" id="iframe-upload" src="{{ route('products.fileUpload') }}">
                        @csrf
                    </iframe>
                    <div class="edit__inner-input__file-name">
                        <p>
                            @if (!empty($temporaryFile))
                                {{ pathinfo($temporaryFile, PATHINFO_FILENAME) }}
                            @else
                                ファイル未選択
                            @endif
                        </p>
                    </div>
                </div>

                @if ($errors->has('image'))
                    <div class="error-message__file">
                        <span>{{ $errors->first('image') }}</span>
                    </div>
                @endif
                <div class="error-message__file_default">
                    <p>※ファイルを選択後、ファイル名・画像が本画面にて即時プレビュー表示されない場合でも登録は可能です。</br>　登録後、一覧画面からご確認ください。</p>
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
                        <input type="checkbox" id="checkbox{{ $value }}" name="season[]" value="{{ $value }}" {{ in_array($value, old('season', [])) ? 'checked' : '' }}>
                        <label for="checkbox{{ $value }}" class="season1">{{ $label }}</label>
                    @endforeach

                    @if ($errors->has('season'))
                        <div class="error-message__season">
                            <span>{{ $errors->first('season') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- 商品説明 -->
            <div class="register__inner-textarea">
                <h3 class="register__inner-input__ttl">商品説明<span class="required-red-span">必須</span></h3>
                <textarea class="register__inner-input__textarea" name="description" rows="6" cols="30" placeholder="例）爽やかな香りと上品な甘みが特長的なキウイは大人から子どもまで大人気のフルーツです。疲れた脳や体のエネルギー補給にも最適の商品です。もぎたてフルーツのスムージーをお召し上がりください！">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                    <div class="error-message__description">
                        <span>{{ $errors->first('description') }}</span>
                    </div>
                @endif
            </div>

            <!-- ボタン -->
            <div class="register__inner-btn">
                <button class="register__inner__btn-submit btn-gray" type="button" onclick="location.href='/products';" id="btn-back" value="">戻る</button>
                <button form="product-form" class="register__inner__btn-submit btn-yellow" type="submit" id="btn-submit" value="">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection

