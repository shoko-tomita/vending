<link rel="stylesheet" href="{{ asset("/css/style.css") }}">

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
                <div class="panel-heading">企業情報登録</div>
                <div class="panel-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $message)
                        <p>{{ $message }}</p>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{ route('newcreate2') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">会社名</label>
                            <input type="text" class="form-control" name="company_name" id="company_name" value="" />
                            <label for="title">住所</label>
                            <input type="text" class="form-control" name="street_address" id="street_address" value="" />
                            <label for="position">代表者名</label>
                            <input type="text" class="form-control" name="representative_name" id="representative_name" value="" />
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">登録</button>
                            <button type="button" class="btn btn-primary" onClick="history.back()">戻る</button>
                        </div>
                        </form>
            </nav>

        </div>
    </div>