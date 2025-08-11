@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css')}}">
@endsection

<!-- 商品詳細画面 -->
<!-- http://localhost/products/{productId} -->
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
            <div class="edit__inner-detail-form__form-1">
                <form action="{{ route('file.update', ['productId' => $product->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="edit__inner__fruit-container">
                        <div class="edit__inner__grid-fruit-img">
                            <!-- ファイルがstorageに一時保存されたらプレビュー表示、されなければ一覧画面からの値受け渡しのみ -->
                            @if (!empty($temporaryFile))
                            <img src="{{ asset($temporaryFile) }}" alt="選択したファイル">
                            @else
                            <img src="{{ asset($image) }}" alt="{{ pathinfo($image, PATHINFO_BASENAME) }}">
                            @endif
                        </div>

                        <div class="edit__inner-select">
                            <label class="register__inner-input__file" type="button" for="file-edit">
                                <input class="register__inner-input__file-submit" type="file" name="image" accept="image/*" id="file-edit" onchange="this.form.submit()"/>
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
                    </div>
                </form>
                <div class="edit__inner__input-container">
                    <label class="edit__inner-input" for="name">
                        <h3 class="edit__inner-input__ttl">商品名</h3>
                        <div class="edit__inner-input__input">
                            <input class="edit__inner-input__input-submit" type="text" name="name" id="name" value="{{ $name }}" placeholder="商品名を入力">
                        </div>
                    </label>
                    <label class="edit__inner-input" for="price">
                        <h3 class="edit__inner-input__ttl">値段</h3>
                        <div class="edit__inner-input__input">
                            <input class="edit__inner-input__input-submit" type="text" name="price" id="price" value="{{ $price }}" placeholder="値段を入力">
                        </div>
                    </label>
                    <div class="edit__inner-input">
                        <h3 class="edit__inner-input__ttl">季節</h3>
                        <div class="edit__inner-input__checkbox">
                            @foreach ($allSeasons as $index => $season)
                            <input id="checkbox{{ $index }}" type="checkbox" name="seasons[]" value="{{ $season->id }}"
                            @if(isset($product) && $product->seasons->pluck('id')->contains($season->id)) checked @endif>
                            <label for="checkbox{{ $index }}" class="season{{ $index }}">{{ $season->name }}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="edit__inner-detail-form__form-2">
                <label class="edit__inner-textarea" for="description">
                    <h3 class="edit__inner-input__ttl">商品説明</h3>
                    <textarea class="edit__inner-input__textarea" id="description" name="description" rows="6" cols="30" placeholder="">{{ $description }}</textarea>
                </label>
                <div class="edit__inner-btn">
                    <label class="edit__inner-btn" for="btn-edit">
                        <input class="register__inner__btn-submit btn-gray" type="button" onclick="location.href='/products';" value="戻る" id="btn-edit">
                        <input class="register__inner__btn-submit btn-yellow edit-btn-yellow" type="submit" name="name" id="btn" value="変更を保存">
                    </label>
                    <label class="trash-delete">
                        <button type="submit" aria-label="削除ボタン">
                            <img class="trash-can" src="/trash-can.png" alt="削除ボタン">
                        </button>
                    </label>
                </div>
                
            </div>

        </div>
    </div>
@endsection