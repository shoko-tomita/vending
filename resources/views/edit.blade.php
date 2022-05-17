<link rel="stylesheet" href="{{ asset("/css/style.css") }}">

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
                <div class="panel-heading">商品情報の編集</div>
                <div class="panel-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $message)
                        <p>{{ $message }}</p>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{ route('update' , [ 'id'=> $product->id] ) }}" method="POST">
                        @csrf
                        <label for="title">会社名</label>
                        <select class="form-select" aria-label="Default select" name="company_id">
                            @foreach($companys as $c)
                            <option value="{{$c->id}}"@if($c->id == $company_id) selected @endif>{{$c->company_name}}</option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="title">商品名</label>
                            <input type="text" class="form-control" name="product_name" id="title" value="{{ $product->product_name }}" />
                            <label for="title">値段</label>
                            <input type="number" class="form-control" name="price" id="text" value="{{ $product->price }}" />
                            <label for="title">在庫</label>
                            <input type="number" class="form-control" name="stack" id="text" value="{{ $product->stack }}" />
                            <label for="title">コメント</label>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="{{ $product->comment }}" id="floatingTextarea" style="height: 100px" name="comment"></textarea>
                            </div>

                            <label for="title">商品画像</label>
                            <input type="file" class="form-control" name="img" id="text" value="{{ $product->imgpath }}" />
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">更新</button>

                            <a class="btn btn-primary" href="#" onClick="history.back()">戻る</a>
                        </div>
                    </form>
                </div>
            </nav>

        </div>
    </div>
</div>