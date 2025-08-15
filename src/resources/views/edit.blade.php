@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css')}}">
@endsection

<!-- 商品詳細ページ(更新画面) -->
@section('content')
<div class="edit">

    <div class="edit__heading">
        <nav class="edit__heading-nav" aria-label="breadcrumb">
            <ol class="edit__heading-nav__breadcrumbs">
                <li class="breadcrumb-item-home"><a href="/products">商品一覧</a></li>
                    <span class="breadcrumb-item-arrow">></span>
                <li class="breadcrumb-item-active" aria-current="page">{{ $name }}</li>
            </ol>
        </nav>
    </div>

    <div class="edit__inner">

        <div class="edit__inner-detail-form">

            <form action="{{ route('products.update', ['productId' => $productId]) }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="edit__inner-detail-form__form-1">

                    <!-- 商品画像 -->
                    <div class="edit__inner__fruit-container">
                        <div class="edit__inner__grid-fruit-img">
                            @if (!empty($temporaryFile))
                                <img src="{{ asset($temporaryFile) }}" alt="選択したファイル">
                            @else
                            <!-- これ動かしちゃダメだよ -->
                                <img src="{{ asset($image) }}" alt="{{ pathinfo($image, PATHINFO_BASENAME) }}">
                            @endif
                        </div>

                        <div class="edit__inner-select">
                            <label class="register__inner-input__file" type="button" for="file-edit">
                                <input class="register__inner-input__file-submit" type="file" name="image" id="file-edit" accept="image/*" />
                                ファイルを選択
                            </label>
                            <div class="edit__inner-input__file-name">
                                <p>
                                    @if (!empty($temporaryFile))
                                        {{ pathinfo($temporaryFile, PATHINFO_FILENAME) }}
                                    @else
                                        {{ pathinfo($image, PATHINFO_FILENAME) }}
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
                            <p>※ファイルを選択後、ファイル名・画像が本画面にて</br>&nbsp;&nbsp;&nbsp;即時プレビュー表示されない場合でも変更は可能です。</br>&nbsp;&nbsp;&nbsp;変更を保存後、一覧画面からご確認ください。</p>
                        </div>
                    </div>

                    <div class="edit__inner__input-container">

                        <!-- 商品名 -->
                        <div class="edit__inner-input" >
                            <h3 class="edit__inner-input__ttl">商品名</h3>
                            <label class="edit__inner-input__input" for="name-product">
                                <input class="edit__inner-input__input-submit" type="text" name="name" value="{{ old('name', $product->name ?? '') }}" id="name-product" placeholder="商品名を入力">
                                <input type="hidden" name="id" value="{{ $product->id ?? old('id') }}">
                            </label>
                            @if ($errors->has('name'))
                                <div class="error-message__name">
                                    <span>{{ $errors->first('name') }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- 値段 -->
                        <div class="edit__inner-input">
                            <h3 class="edit__inner-input__ttl">値段</h3>
                            <label class="edit__inner-input__input" for="price-edit">
                                <input class="edit__inner-input__input-submit" type="text" name="price" value="{{ old('price', $product->price ?? '') }}" id="price-edit" placeholder="値段を入力">
                                <input type="hidden" name="id" value="{{ $product->id ?? old('id') }}">
                            </label>
                            @if ($errors->has('price'))
                                <div class="error-message__price">
                                    <span>{{ $errors->first('price') }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- 季節 -->
                        <div class="edit__inner-input">
                            <h3 class="edit__inner-input__ttl">季節</h3>
                            <div class="edit__inner-input__checkbox">
                                @foreach ($allSeasons as $index => $season)
                                    <input 
                                        id="checkbox{{ $index }}" 
                                        type="checkbox" 
                                        name="season[]" 
                                        value="{{ $season->id }}" 
                                        @if(old('season') && in_array($season->id, old('season'))) checked 
                                        @elseif(isset($product) && $product->seasons->pluck('id')->contains($season->id)) checked 
                                        @endif>
                                    <label for="checkbox{{ $index }}" class="season{{ $index }}">
                                        {{ $season->name }}
                                    </label>
                                @endforeach

                                @if ($errors->has('season'))
                                    <div class="error-message__season">
                                        <span>{{ $errors->first('season') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>

                <!-- 商品説明 -->
                <div class="edit__inner-detail-form__form-2">
                    <div class="edit__inner-textarea" for="description">
                        <h3 class="edit__inner-input__ttl">商品説明</h3>
                        <textarea class="edit__inner-input__textarea" id="description" name="description" rows="6" cols="30" placeholder="">{{ old('description', $product->description ?? '') }}</textarea>
                        @if ($errors->has('description'))
                            <div class="error-message__description">
                                <span>{{ $errors->first('description') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- ボタン -->
                <div class="edit__inner-detail-form__form-3">
                    <div class="edit__inner-btn">
                        <button class="register__inner__btn-submit btn-gray"
                            onclick="window.location.href='/products';" id="btn-edit">
                            戻る
                        </button>
                        <button class="register__inner__btn-submit btn-yellow edit-btn-yellow" type="submit" id="btn">
                            変更を保存
                        </button>
                    </div>
                </div>

            </form>

            <!-- ゴミ箱マーク -->
            <form class="edit__inner-delete-form" action="{{ route('products.destroy', ['productId' => $productId]) }}" method="post">
                @method('DELETE')
                @csrf
                <label class="trash-delete">
                    <button type="submit" aria-label="削除ボタン">
                        <img class="trash-can" src="/trash-can.png" alt="削除ボタン">
                    </button>
                </label>
            </form>

        </div>
    </div>
@endsection