    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=
        , initial-scale=1.0">
        <title>商品情報一覧</title>
        <link rel="stylesheet" href="{{ asset("/css/style.css") }}">
        <!-- <link rel="stylesheet" href="../../public/css/style.css"> -->
    </head>

    <body>

        <header id="header">
            <h3>商品一覧情報</h3>
        </header>

            <a href="{{ route('create') }}" class="btn btn-primary">商品情報登録</a>

        <main>

            @foreach ($vendings as $vending)
            <div>{{ $vending->product_name }}</div>

                    <a href="{{ route('disp',['id' => $vending->id]) }}" class="btn btn-primary">商品情報詳細</a>

            @endforeach

                <!-- {{-- <a  href="#" id="logout">ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>・
                <a href="{{ route('user.withdrawal') }}" onclick="res = confirm('本当に退会しますか？');
                event.preventDefault();
                if( res == true ) {
                    document.getElementById('withdrawal-form').submit();
                }">
                退会
                </a>
                <form id="withdrawal-form" action="{{ route('user.withdrawal') }}" method="post" style="display: none;"> --}} -->


            </div>
        </main>
        <footer>
            <a  href="#" id="logout">ログアウト</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>・
            <a href="{{ route('user.withdrawal') }}" onclick="res = confirm('本当に退会しますか？');
            event.preventDefault();
            if( res == true ) {
            document.getElementById('withdrawal-form').submit();
            }">
            退会
            </a>
            <form id="withdrawal-form" action="{{ route('user.withdrawal') }}" method="post" style="display: none;">
            @csrf
            <form>
        </footer>
        <script>
            document.getElementById('logout').addEventListener('click', function(event) {
                event.preventDefault();
                document.getElementById('logout-form').submit();
            });
        </script>
    </body>

    </html>