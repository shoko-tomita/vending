<link rel="stylesheet" href="{{ asset("/css/style.css") }}">

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
                    <form action="" method="POST">
                        @csrf
                        <div class="text-center">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">ID:{{ $product->id}}</p>
                                <p class="card-title">商品名:{{ $product->product_name }}</p>
                                <p class="card-text">価格:{{ $product->price}}</p>
                                <p class="card-text">在庫:{{ $product->stack}}</p>
                                <p class="card-text">コメント:{{ $product->comment}}</p>
                                <img src=" {{asset('/image/'.$product->img_path)}}">
                            </div>
                        </div>

                        </div>
                <br>
                <div class="text-right">
                    <a href="{{ route('edit',['id' => $product->id]) }}" class="btn btn-primary">編集</a>
                    <a class="btn btn-primary" href="#" onClick="history.back()">戻る</a>
                </form>
                </div>
                <br>

                {{--<a href="{{ route('edit',['id' => $product->id]) }}" class="btn btn-primary">編集</a>
                <a class="btn btn-primary" href="#" onClick="history.back()">戻る</a>--}}
                </form>
                </div>