<link rel="stylesheet" href="{{ asset("/css/style.css") }}">

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
                <div class="panel-heading">商品情報登録</div>
                <div class="panel-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $message)
                        <p>{{ $message }}</p>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{ route('newcreate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="title">会社名</label>
                        <select class="form-select" aria-label="Default select" name="company_id">
                            @foreach($companys as $c)
                            <option value="{{$c->id}}">{{$c->company_name}}</option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="title">商品名</label>
                            <input type="text" class="form-control" name="product_name" id="product_name" value="" />
                            <label for="title">値段</label>
                            <input type="number" class="form-control" name="price" id="price" value="" />
                            <label for="position">在庫</label>
                            <input type="number" class="form-control" name="stack" id="stack" value="" />
                            <label for="title">コメント</label>
                            <div class="form-floating">
                                <textarea class="form-control" id="floatingTextarea" style="height: 100px" name="comment"></textarea>
                            </div>

                            {{--<form method="POST" action="{{route('upload.store')}}" enctype="multipart/form-data">--}}
                                @csrf
                            <label for="title">商品画像</label>
                            <input type="file" class="form-control" name="img_path" id="file" value="" />
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">登録</button>
                            <button type="button" class="btn btn-primary" onClick="history.back()">戻る</button>
                        </div>
                        </form>
            </nav>

        </div>
    </div>