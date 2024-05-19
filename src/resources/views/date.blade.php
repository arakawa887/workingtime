@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
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
<a href="{{ route('yesterday.show', ['day' => $yesterday]) }}"> < </a>
<h1>{{ $day->format('Y-m-d') }}</h1>
<a href="{{ route('yesterday.show', ['day' => $tomorrow]) }}"> > </a>
<table>
  <tr>
    <th>名前</th>
    <th>勤務開始</th>
    <th>勤務終了</th>
    <th>休憩時間</th>
    <th>勤務時間</th>
  </tr>
  <tr>
  foreach($results as ->$result){
    <td>
      {{$result->users.name}}
    </td>
    <td>
      {{$result->users.name}}
    </td>
  }
  </tr>
</table>

@endsection