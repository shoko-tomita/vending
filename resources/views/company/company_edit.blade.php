<link rel="stylesheet" href="{{ asset("/css/style.css") }}">

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
                <div class="panel-heading">企業情報の編集</div>
                <div class="panel-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $message)
                        <p>{{ $message }}</p>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{ route('up' , [ 'id'=> $company->id] ) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">会社名</label>
                            <input type="text" class="form-control" name="company_name" id="title" value="{{ $company->company_name }}" />
                            <label for="title">住所</label>
                            <input type="text" class="form-control" name="street_address" id="text" value="{{ $company->street_address}}" />
                            <label for="title">代表者名</label>
                            <input type="text" class="form-control" name="representative_name" id="text" value="{{ $company->representative_name }}" />

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