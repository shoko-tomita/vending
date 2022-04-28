<link rel="stylesheet" href="{{ asset("/css/style.css") }}">

<body>

    <header id="header">
        <ul class="my-list">
            <li>こんにちは{{ Auth::user()->name }}さん</li>
        </ul>
        <h3>商品一覧情報</h3>
    </header>
    <a href="{{ route('create') }}" class="btn btn-primary">商品情報登録</a>
    @if (session('login_success'))
    @endif

    @foreach ($products as $product)
    <div class="card">
        <div class="card-header">
            {{ $product->product_name }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $product->id}}</h5>
            <p class="card-title">{{ $product->price}}</p>
            <p class="card-title">{{ $product->stack}}</p>
            <p class="card-title">{{ $product->company}}</p>
            <img src=" {{asset('/image/'.$product->img_path)}}">
            <a href="{{ route('disp',['id' => $product->id]) }}" class="btn btn-primary">商品情報詳細</a>
            <form action="{{url('vennding_all/'.$product->id)}}" method="POST">
                <br>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-primary">削除</button>
            </form>
        </div>
    </div>
    @endforeach





    {{--ログアウト機能--}}
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