@extends('layouts.user')

@section('page-title')
    パスワードリセットメール送信完了
@endsection

@section('page-content')
    <div>
        <h1>パスワードリセットメールを送信しました。</h1>

        <a href="{{ route('login') }}">TOPへ</a>
    </div>
@endsection