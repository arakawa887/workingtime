@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamping.css') }}">
@endsection

@section('logout')
<form class="stamp" action="/" method="get">
  @csrf
  <button class="stamp-form__button-submit" type="submit">ホーム</button>
</form>

<form class="attendance" action="/attendance" method="post">
  @csrf
  <button class="attendance-form__button-submit" type="submit">日付一覧</button>
</form>

<form class="logout" action="/logout" method="post">
@csrf
<button class="logout-button">ログアウト</button>
</form>
@endsection

@section('content')

<h2>{{$username}}さんお疲れ様です！</h2>
<form class="work-start" action="/work-start" method="post">
@csrf
<button class="work-start-button">勤務開始</button>
</form>

<form class="work-finish" action="/work-finish" method="post">
@csrf
<button class="finish-button">勤務終了</button>
</form>

<form class="break-start" action="/break-start" method="post">
@csrf
<button class="break-start-button">休憩開始</button>
</form>

<form class="break-finish" action="/break-finish" method="post">
@csrf
<button class="break-finish-button">休憩終了</button>
</form>
@endsection