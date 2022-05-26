<link rel="stylesheet" href="{{ asset("/css/style.css") }}">

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
                <div class="panel-heading">企業情報の詳細</div>
                <div class="panel-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $message)
                        <p>{{ $message }}</p>
                        @endforeach
                    </div>
                    @endif
                    <form action="" method="POST">
                        @csrf
                        <div class="text-center">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">ID:{{ $company->id}}</p>
                                <p class="card-title">会社名:{{ $company->company_name }}</p>
                                <p class="card-text">住所:{{ $company->street_address}}</p>
                                <p class="card-text">代表者名:{{ $company->representative_name}}</p>
                            </div>
                        </div>

                        </div>
                <br>
                <div class="text-right">
                    <a href="{{ route('edit',['id' => $company->id]) }}" class="btn btn-primary">編集</a>
                    <a class="btn btn-primary" href="#" onClick="history.back()">戻る</a>
                </form>
                </div>
                <br>
                </form>
                </div>