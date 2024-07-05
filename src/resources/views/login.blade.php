@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class = "register">
  <div class = "register-title">
  <h2>ログイン</h2>
  </div>
<form class = "form" action = "/login" method = "post">
  @csrf
  <p class = "contents-inputted">メールアドレス</p>
  <input type = "email" name = "email" value = "{{ old('email') }}" ><br>
  <p class = "contents-inputted">パスワード</p>
  <input type = "password" name = "password" ><br>
  <button class = "register-form__button-submit" type = "submit">ログイン</button>
</form>
<p>アカウントをお持ちでない方はこちらから</p>
<form class = "login-move" action = "/register" method = "get">
  @csrf
  <button class = "login-form__button-submit" type = "submit">会員登録</button>
</form>
</div>
@endsection