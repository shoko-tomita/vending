<link rel="stylesheet" href="{{ asset("/css/style.css") }}">
    @section('content')
    <div class="container">
        <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
            <div class="panel-heading">新規登録</div>
            <div class="panel-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $message)
                    <p>{{ $message }}</p>
                    @endforeach
                </div>
                @endif

                @if (session('login_error'))
                    <div class="alert alert-danger">
                        {{ session('login_error')}}
                    </div>
                    @endif
                <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">お名前</label>
                    <input type="text" class="form-control" id="name" name="name" value="" />
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="text" class="form-control" id="email" name="email" value="" />
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" class="form-control" id="password" name="password" />
                </div>
                <div class="form-group">
                    <label for="password">パスワード確認</label>
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" />
                </div>


                <div class="text-right">
                    <button type="submit" class="btn btn-primary">送信</button>
                </div>
                </form>
            </div>
            </nav>
            <div class="text-center">
            <a href="{{ route('login.show') }}">ログイン</a>
            </div>
        </div>
        </div>

    </div>