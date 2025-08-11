
<!-- create.blade.phpの中に組み込み -->

<form action="{{ route('create') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="register__inner-select">
        <h3 class="register__inner-input__ttl">商品画像<span class="required-red-span">必須</span></h3>
        <div class="edit__inner__grid-fruit-img">
            <!-- ファイルがstorageに一時保存されたらプレビュー表示、されなければ何も表示しない -->
            @if (session('temporaryFile'))
            <img src="{{ asset(session('temporaryFile')) }}" alt="選択したファイル">
            @endif
        </div>
        <div class="edit__inner__file-select" for="file-register">
            <label class="register__inner-input__file" id="file-register" type="button">
                <input class="register__inner-input__file-submit" type="file" name="image" accept="image/*" onchange="this.form.submit()"/>
                ファイルを選択
            </label>
            <div class="edit__inner-input__file-name">
                <p>
                    @if (!empty($temporaryFile))
                        {{ pathinfo($temporaryFile, PATHINFO_FILENAME) }}
                    @else
                        未選択
                    @endif
                </p>
            </div>
        </div>
    </div>
</form>
