
    <link rel="stylesheet" href="{{ asset("/css/style.css") }}">

    @section('content')
    <div class="container">
        <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
            <div class="panel-heading">商品情報の編集</div>
            <div class="panel-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $message)
                    <p>{{ $message }}</p>
                    @endforeach
                </div>
                @endif
                <form action="{{ route('update'),['id' => $product->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">商品名</label>
                    <input type="text" class="form-control" name="product" id="title" value="{{ old('product_name') }}" />
                    <label for="title">値段</label>
                    <input type="text" class="form-control" name="price" id="text" value="{{ old('price') }}" />
                    <label for="title">在庫</label>
                    <input type="text" class="form-control" name="stack" id="text" value="{{ old('stack') }}" />
                    <label for="title">コメント</label>
                    <input type="position" class="form-control" name="comment" id="position" value="{{ old('comment') }}" />
                    <label for="title">商品画像</label>
                    <input type="text" class="form-control" name="img" id="text" value="{{ old('img_path') }}" />
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">編集</button>
                </div>
                </form>
            </div>
            </nav>

        </div>
        </div>
    </div>