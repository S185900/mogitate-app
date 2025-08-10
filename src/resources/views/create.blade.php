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
        <form class="register__inner__form" method="post">
            @csrf
            <label class="register__inner-input" for="name">
                <h3 class="register__inner-input__ttl">商品名<span class="required-red-span">必須</span></h3>
                <div class="register__inner-input__input">
                    <input class="register__inner-input__input-submit" type="text" name="name" id="name" value="" placeholder="商品名を入力">
                </div>
            </label>
            <label class="register__inner-input" for="price">
                <h3 class="register__inner-input__ttl">値段<span class="required-red-span">必須</span></h3>
                <div class="register__inner-input__input">
                    <input class="register__inner-input__input-submit" type="text" name="price" id="price" value="" placeholder="値段を入力">
                </div>
            </label>
            <label class="register__inner-select" for="file">
                <h3 class="register__inner-input__ttl">商品画像<span class="required-red-span">必須</span></h3>
                <div class="register__inner-input__file" id="file" type="button">
                    <input class="register__inner-input__file-submit" type="file" name="image" id="file" accept="image/*"/>
                    ファイルを選択
                </div>
            </label>
            <div class="register__inner-input">
                <h3 class="register__inner-input__ttl">
                    季節
                    <span class="required-red-span">必須</span>
                    <span class="required-red-text">複数選択可</span>
                </h3>
                <div class="register__inner-input__checkbox" for="checkbox1">
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
            <label class="register__inner-textarea" for="description">
                <h3 class="register__inner-input__ttl">商品説明<span class="required-red-span">必須</span></h3>
                <textarea class="register__inner-input__textarea" id="description" name="description" rows="6" cols="30" placeholder="例）爽やかな香りと上品な甘みが特長的なキウイは大人から子どもまで大人気のフルーツです。疲れた脳や体のエネルギー補給にも最適の商品です。もぎたてフルーツのスムージーをお召し上がりください！"></textarea>
            </label>
            <label class="register__inner-btn" for="btn">
                <input class="register__inner__btn-submit btn-gray" type="button" onclick="location.href='/products';" id="btn" value="戻る">
                <input class="register__inner__btn-submit btn-yellow" type="submit" name="name" id="btn" value="登録">
            </label>
        </form>
    </div>
</div>
@endsection

