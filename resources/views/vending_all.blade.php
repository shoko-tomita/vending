<link rel="stylesheet" href="{{ asset("/css/style.css") }}">
</head>

<body>

    <header id="header">
        <ul class="my-list">
            <li>こんにちは{{ Auth::user()->name }}さん</li>
        </ul>
        <h3>商品一覧情報</h3>
    </header>

<form action="{{route('search')}}">
    <select class="form-select" aria-label="Default select" name="company_id">
        {{--@foreach($companys as $c)
            <option value="{{$c->id}}">{{$c->company_name}}</option>
        @endforeach--}}
    <input type="text" name="word">
    <input type="submit" class="btn btn-primary" value="検索">
</form>

{{--<form action="{{route('article.list')}}">--}}
<button type="submit" class="btn btn-primary" name="sort" value="@if (!isset($sort) || $sort !== '1') 1 @elseif ($sort === '1') 2 @endif">価格順</button>
<button type="submit" class="btn btn-primary" name="sort" value="@if (!isset($sort) || $sort !== '3') 3 @elseif ($sort === '3') 4 @endif">在庫順</button>
</form>
<br><br>
    <a href="{{ route('create') }}" class="btn btn-primary">商品情報登録</a>

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

        @foreach ($products as $product)
        <div>{{ $product->id}}</div>
        <div>{{ $product->product_name }}</div>
        <div>{{ $product->price}}</div>
        <div>{{ $product->stack}}</div>
        <div>{{ $product->company}}</div>
        <img src=" {{asset('/image/'.$product->img_path)}}">

        <a href="{{ route('disp',['id' => $product->id]) }}" class="btn btn-primary">商品情報詳細</a>
        {{-- <form action="{{url('vennding_all/'.$product->id)}}" method="POST"> --}}
        <form action="{{route ('delete',$product->id)}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">削除</button>

        </form>
        @endforeach

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