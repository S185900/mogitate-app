@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
<div class="index">
    <div class="index__heading-flex">
        <h2 class="index__heading-ttl">商品一覧</h2>
        <div class="index__heading-btn btn-orange">
            <a class="index__heading-btn-submit" href="{{ route('products.register') }}">&#43; 商品を追加</a>
        </div>
    </div>
    <div class="index__inner">
        <nav class="index__inner__sidebar">
            <form action="{{ route('products.search') }}" method="get">
                <label class="index__inner-input text-search" for="product-name">
                    <input class="index__inner__sidebar-search-submit" id="product-name" type="text" name="name" value="{{ request('name') }}" placeholder="商品名で検索">
                </label>
                <div class="index__inner-btn btn-yellow">
                    <button class="index__inner__sidebar-btn-submit" type="submit">検索</button>
                </div>
            </form>

            <form action="{{ route('products.search') }}" method="get">
                <h3 class="index__inner__sidebar-h3-ttl">価格順で表示</h3>
                <label class="index__inner__sidebar-select" for="price">
                    <select class="index__inner__sidebar-select-price" name="sort" id="price" onchange="this.form.submit()">
                        <option disabled {{ !request('sort') ? 'selected' : '' }}>価格で並べ替え</option>
                        <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>高い順に表示</option>
                        <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>低い順に表示</option>
                    </select>
                </label>

                <!-- ソート検索されたら表示されるタブ -->
                <div class="index__inner__sidebar-filter-tabs" style="{{ request('sort') == 'high' ? 'display: block;' : 'display: none;' }}">
                        <label class="index__inner__sidebar-filter-tabs__display" for="close">
                            <input class="close-tab" type="checkbox" value="" id="close" />
                            高い順に表示<span class="close_btn"></span>
                        </label>
                </div>
                <div class="index__inner__sidebar-filter-tabs" style="{{ request('sort') == 'low' ? 'display: block;' : 'display: none;' }}">
                    <label class="index__inner__sidebar-filter-tabs__display" for="close">
                        <input class="close-tab" type="checkbox" value="" id="close" />
                        低い順に表示<span class="close_btn"></span>
                    </label>
                </div>
            </form>
        </nav>
        <div class="index__inner__grid">
            @foreach ($products as $product)
            @csrf
            <div class="index__inner__grid-fruit-card" onclick="location.href='/products/{{ $product->id }}'">
                <img src="{{ asset($product->image) }}" alt="{{ pathinfo($product->image, PATHINFO_FILENAME) }}">
                <div class="index__inner__grid-fruit-card__product-info">
                    <h3>{{ $product->name }}</h3>
                    <p>¥{{ number_format($product->price) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="paginate">
        <!-- {{ $products->links() }} -->
        {{ $products->appends(request()->query())->links('vendor.pagination.custom') ?? '' }}
    </div>
</div>
@endsection

