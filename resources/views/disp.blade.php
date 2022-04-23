<!-- <link rel="stylesheet" href="{{ asset("/css/style.css") }}"> -->
<link rel="stylesheet" href="../../public/css/style.css">
@section('content')
    <div class="container">
        <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
            <div class="panel-heading">商品情報の詳細</div>
            <div class="panel-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $message)
                    <p>{{ $message }}</p>
                    @endforeach
                </div>
                @endif

                @csrf

                <div class="card">
                    <div class="card-body">
                        <!-- 商品名 -->
                        <h5 class="card-title"> {{ $thread->title }}</h5>
                        <!-- 値段 -->
                        <p class="card-text">{{ $thread->thread_detail }}</p>
                        <!-- 在庫 -->
                        <p class="card-text">{{ $thread->thread_detail }}</p>
                        <!-- コメント -->
                        <input type="position" class="form-control" name="position" id="position" value="{{ old('position') }}" />
                        <!-- 画像 -->
                        <img class="card-text">{{ $thread->thread_detail }}
                        </div>
                        </div>
                        </div>
                <br>
                <a href="{{ route('vending_all') }}" class="btn btn-primary">戻る</a>
                <a href="{{ route('edit') }}" class="btn btn-primary">編集</a>
