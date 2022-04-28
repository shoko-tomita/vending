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

                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">{{ $product->id}}</p>
                                <h5 class="card-title">{{ $product->product_name }}</h5>
                                <p class="card-text">{{ $product->price}}</p>
                                <p class="card-text">{{ $product->stack}}</p>
                                <p class="card-text">{{ $product->comment}}</p>
                                <img src=" {{asset('/image/'.$product->img_path)}}">
                            </div>
                        </div>
                </div>
                <br>

                <a href="{{ route('edit',['id' => $product->id]) }}" class="btn btn-primary">編集</a>
                <a class="btn btn-primary" href="#" onClick="history.back()">戻る</a>
                </form>