
    <!-- <link rel="stylesheet" href="{{ asset("/css/style.css") }}"> -->
    <link rel="stylesheet" href="../../public/css/style.css">
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
                <form action="{{ route('threads.edit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">商品名</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
                    <label for="title">値段</label>
                    <input type="text" class="form-control" name="text" id="text" value="{{ old('text') }}" />
                    <label for="title">在庫</label>
                    <input type="text" class="form-control" name="text" id="text" value="{{ old('text') }}" />
                    <label for="title">コメント</label>
                    <input type="position" class="form-control" name="position" id="position" value="{{ old('position') }}" />
                    <label for="title">商品画像</label>
                    <input type="text" class="form-control" name="text" id="text" value="{{ old('text') }}" />
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