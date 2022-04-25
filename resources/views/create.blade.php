<link rel="stylesheet" href="{{ asset("/css/style.css") }}">

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
            <div class="panel-heading">商品情報登録</div>
               
                <div class="panel-body">
            @if($errors->any())
                <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                    <p>{{ $message }}</p>
                @endforeach
                </div>
            @endif
            <form action="{{ route('create') }}" method="POST">
                @csrf
                <div class="form-group">
                <label for="title">商品名</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
                <label for="title">値段</label>
                <input type="text" class="form-control" name="text" id="text" value="{{ old('text') }}" />
                <label for="position">在庫</label>
                <input type="position" class="form-control" name="position" id="position" value="{{ old('position') }}" />
                <label for="title">コメント</label>
                <input type="text" class="form-control" name="text" id="text" value="{{ old('text') }}" />
                <label for="title">商品画像</label>
                <input type="text" class="form-control" name="text" id="text" value="{{ old('text') }}" />
                </div>
                <div class="text-right">
                <button type="button" class="btn btn-primary" onClick="history.back()">戻る</button>
                <button type="submit" class="btn btn-primary">登録</button>
                </div>
        </nav>

        </div>
    </div>
