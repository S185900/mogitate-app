<!-- iFrame独立ファイル選択とプレビュー表示だけのpost -->

<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" target="iframe-upload">
    @csrf
    <label class="register__inner-input__file" id="file-register" type="button" for="file-register">
        <input class="register__inner-input__file-submit" type="file" name="image" accept="image/*" />
        ファイルを選択
    </label>
</form>



