<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>

<body>

    <header id="header">
        <ul class="my-list">
            <li>こんにちは{{ Auth::user()->name }}さん</li>
        </ul>
        <h3>企業一覧情報</h3>
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
                <option value="2">会社名</option>
                <option value="3">住所</option>
                <option value="4">代表者名</option>
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
            <a href="{{ route('create2') }}" class="btn btn-primary">企業登録</a>
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
                    @foreach ($companys as $company)
                    <div class="col col-md-offset-3 col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <label for="">ID:{{ $company->id}}</label>
                            </div>
                            <div class="panel-body">
                                <div>会社名:{{ $company->company_name }}
                                </div>
                                <div>住所:{{ $company->street_address}}</div>
                                <div>代表者名:{{ $company->representative_name}}</div>
                                <br>
                                <a href="{{ route('edit2',['id' => $company->id]) }}" class="btn btn-primary">編集</a>
                                <form action="" method="POST">
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
            <div class="row">
                <div class="col-md-4 offset-md-4">{{ $companys->links()}}</div>
            </div>
        </main>
        <br>
        <footer>
            <div class="text-center">
                <a href="{{ route('vending_all') }}">戻る</a>・
                <a href="#" id="logout">ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
            </div>
            </form>
        </footer>
        <script>
            document.getElementById('logout').addEventListener('click', function(event) {
                event.preventDefault();
                document.getElementById('logout-form').submit();
            });
        </script>
</body>