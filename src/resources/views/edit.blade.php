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
                <li class="breadcrumb-item-active" aria-current="page">キウイ</li>
            </ol>
        </nav>
    </div>
    <div class="edit__inner">
        <div class="edit__inner-detail-form">
            <div class="edit__inner-detail-form__form-1">
                <div class="edit__inner__fruit-container">
                    <div class="edit__inner__grid-fruit-img">
                        <img src="/storage/kiwi.png" alt="フルーツ画像">
                    </div>

                    <label class="edit__inner-select" for="file">
                        <div class="register__inner-input__file" id="file" type="button">
                            <input class="register__inner-input__file-submit" type="file" name="image" id="file" accept="image/*"/>
                            ファイルを選択
                        </div>
                        <div class="edit__inner-input__file-name">
                            <p>image01.jpg</p>
                        </div>
                    </label>
                </div>
                <div class="edit__inner__input-container">
                    <label class="edit__inner-input" for="name">
                        <h3 class="edit__inner-input__ttl">商品名</h3>
                        <div class="edit__inner-input__input">
                            <input class="edit__inner-input__input-submit" type="text" name="name" id="name" value="" placeholder="商品名を入力">
                        </div>
                    </label>
                    <label class="edit__inner-input" for="price">
                        <h3 class="edit__inner-input__ttl">値段</h3>
                        <div class="edit__inner-input__input">
                            <input class="edit__inner-input__input-submit" type="text" name="price" id="price" value="" placeholder="値段を入力">
                        </div>
                    </label>
                    <div class="edit__inner-input">
                        <h3 class="edit__inner-input__ttl">季節</h3>
                        <div class="edit__inner-input__checkbox" for="checkbox1">
                            <input type="checkbox" id="checkbox1">
                            <label for="checkbox1" class="season1">春</label>
                            <input type="checkbox" id="checkbox2">
                            <label for="checkbox2" class="season2">夏</label>
                            <input type="checkbox" id="checkbox3">
                            <label for="checkbox3" class="season3">秋</label>
                            <input type="checkbox" id="checkbox4">
                            <label for="checkbox4" class="season4">冬</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="edit__inner-detail-form__form-2">
                <label class="edit__inner-textarea" for="description">
                    <h3 class="edit__inner-input__ttl">商品説明<span class="required-red-span">必須</span></h3>
                    <textarea class="edit__inner-input__textarea" id="description" name="description" rows="6" cols="30" placeholder="例）爽やかな香りと上品な甘みが特長的なキウイは大人から子どもまで大人気のフルーツです。疲れた脳や体のエネルギー補給にも最適の商品です。もぎたてフルーツのスムージーをお召し上がりください！"></textarea>
                </label>
                <div class="edit__inner-btn">
                    <label class="edit__inner-btn" for="btn">
                        <input class="register__inner__btn-submit btn-gray" type="button" onclick="location.href='/products';" id="btn" value="戻る">
                        <input class="register__inner__btn-submit btn-yellow edit-btn-yellow" type="submit" name="name" id="btn" value="変更を保存">
                    </label>
                    <label class="trash-delete" for="delete">
                        <button type="submit"><img class="trash-can" src="/trash-can.png" alt="削除ボタン"></button>
                    </label>
                </div>
                
            </div>

        </div>
    </div>
@endsection