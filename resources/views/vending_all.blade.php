<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>

<body>

    <header id="header">
        <ul class="my-list">
            <li>こんにちは{{ Auth::user()->name }}さん</li>
        </ul>
        <h3>商品一覧情報</h3>
    </header>

    <div class="text-center">
    <form action="{{route('search')}}">
        @csrf
        <select class="form-select" aria-label="Default select" name="company_id">
            <option value="">選択してください</option>
            @foreach($companys as $c)
            <option value="{{$c->id}}">{{$c->company_name}}</option>
            @endforeach
        </select>
            <input type="text" name="word">
            <input type="submit" class="btn btn-primary" value="検索">
    </form>

    {{--<form action="{{route('list')}}" method="POST">
    @csrf
    <select class="form-select" aria-label="Default select" name="sort">
        <option value="">選択してください</option>
        <option value="1">id</option>
        <option value="2">名前</option>
        <option value="3">価格</option>
        <option value="4">在庫</option>
        <option value="5">企業名</option>
    </select>
    <input type="radio" class="btn btn-primary" value="昇順">
    <input type="radio" class="btn btn-primary" value="降順">
    <input type="submit" class="btn btn-primary" value="順">
    </form>--}}

    <form action="{{route('list')}}" method="POST" name="sort">
    <button type="submit" class="btn btn-primary" name="sort" value="1">ID順</button>
    <button type="submit" class="btn btn-primary" name="sort" value="2">名前順</button>
    <button type="submit" class="btn btn-primary" name="sort" value="3">価格順</button>
    <button type="submit" class="btn btn-primary" name="sort" value="4">在庫順</button>
    <button type="submit" class="btn btn-primary" name="sort" value="5">企業名順</button>
    </form>
    <br>
    <div class="text-center">
    <a href="{{ route('create') }}" class="btn btn-primary">商品情報登録</a>
    </div>
    <br>
    <div class="container">
        <div class="mt-5">
            @if (session('login_success'))
            <div class="alert alert-success">
                {{ session('login_success')}}
            </div>
            @endif
        </div>
    </div>

    <main>
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                <div class="col col-md-offset-3 col-md-6">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <label for="">ID:{{ $product->id}}</label>
                    </div>
                        <div class="panel-body">
                            <div>商品名:{{ $product->product_name }}</div>
                            <div>価格:{{ $product->price}}</div>
                            <div>在庫:{{ $product->stack}}</div>
                            <div>商品画像:{{ $product->company}}</div>
                            <img src=" {{asset('/image/'.$product->img_path)}}">
<br>
                            <a href="{{ route('disp',['id' => $product->id]) }}" class="btn btn-primary">商品情報詳細</a>
                            <form action="{{route ('delete',$product->id)}}" method="POST">
                                @csrf
                                <br>
                                <button type="submit" class="btn btn-primary">削除</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </main>
    <footer>
        <a href="#" id="logout">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </footer>
    <script>
        document.getElementById('logout').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        });
    </script>
</body>

</html>