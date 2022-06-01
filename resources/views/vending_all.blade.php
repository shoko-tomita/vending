<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>

<body>

    <header id="header">
        <ul class="my-list">
            <li>こんにちは{{ Auth::user()->name }}さん</li>
            <label for=""><a href="{{ route('all') }}" class="company">企業一覧はこちら</a></label>
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

        <form action="{{route('list')}}" method="POST">
            @csrf
            <select class="form-select" aria-label="Default select" name="sort">
                <option value="">選択してください</option>
                <option value="1">ID</option>
                <option value="2">名前</option>
                <option value="3">価格</option>
                <option value="4">在庫</option>
                <option value="5">企業名</option>
            </select>
            <div class="bd-example">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radioInline" id="inlineRadioDefault" value="up">
                    <label class="form-check-label" for="inlineRadioDefault">昇順</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radioInline" id="inlineRadioChecked" value="down">
                    <label class="form-check-label" for="inlineRadioChecked">降順</label>
                </div>
                <br>
                <input type="submit" class="btn btn-primary" value="並び替え">
            </div>
        </form>
        <br>
        <div class="text-center">
            <a href="{{ route('downloadcsv',
                ['mode'=> $downloadmode,
                'mode_etc' => $downloadmode_etc[0] .  '_' . $downloadmode_etc[1]]
                ) }}" class="btn btn-primary">CSVダウンロード</a>
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
                                <div class="img">
                                    <div>商品画像:{{ $product->company}}</div>
                                    {{--<img src="{{ asset('storage/'.$product->img_path)}}">--}}
                                    <img src=" {{asset('storage/images/'.$product->img_path)}}">
                                </div>
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

            <div class="container">
                @foreach ($products as $product)
                {{ $product->name }}
                @endforeach
            </div>

            {{ $products->links()}}

        </main>
        <br>
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