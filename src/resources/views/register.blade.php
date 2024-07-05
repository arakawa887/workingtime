@extends('layouts.app')

@section('css')
<link rel = "stylesheet" href = "{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class = "register">
  <div class = "register-title">
  <h2>会員登録</h2>
  </div>
<form class = "form" action = "/register" method = "post">
  @csrf
  <p class = "contents-inputted">名前</p>
  <input type = "text" name = "name" value = "{{ old('name') }}" ><br>
  <p class = "contents-inputted">メールアドレス</p>
  <input type = "email" name = "email" value = "{{ old('email') }}" ><br>
  <p class = "contents-inputted">パスワード</p>
  <input type = "password" name = "password" ><br>
  <p class = "contents-inputted">パスワード確認</p>
  <input type = "password" name = "password_confirmation" ><br>
  <button class = "register-form__button-submit" type = "submit">会員登録</button>
</form>
<p>アカウントをお持ちの方はこちらから</p>
<form class = "login-move" action = "/login" method="get">
  @csrf
  <button class = "login-form__button-submit" type = "submit">login</button>
</form>
</div>
@endsection