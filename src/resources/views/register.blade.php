@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register">
  <div class="register-title">
  <h2>会員登録</h2>
  </div>
<form class="form" action="/register" method="post">
  @csrf
  <input type="text" name="name" value="{{ old('name') }}" ><br>
  <input type="email" name="email" value="{{ old('email') }}" ><br>
  <input type="password" name="password" ><br>
  <input type="password" name="password_confirmation" ><br>
  <button class="register-form__button-submit" type="submit">会員登録</button>
</form>
<p>アカウントをお持ちの方はこちらから</p>
<form class="login-move" action="/login" method="get">
  @csrf
  <button class="login-form__button-submit" type="submit">login</button>
</form>
</div>
@endsection