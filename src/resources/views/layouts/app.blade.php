<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="smoothie shop 'mogitate'" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    <link href="https://fonts.cdnfonts.com/css/jsmath-cmti10" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div class="app">
        <div class="header">
            <a class="header__link" href="{{ url('/products') }}">
                <h1 class="header__heading">mogitate</h1>
            </a>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>