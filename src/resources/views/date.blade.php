@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection


@section('content')
<div class="date-handle">
<a href="{{ route('changeDay.show', ['day' => $yesterday]) }}" class="date_change"> < </a>
<div class="date">{{ $day->format('Y-m-d') }}</div>
<a href="{{ route('changeDay.show', ['day' => $tomorrow]) }}" class="date_change"> > </a>
</div>

<table>
  <tr>
    <th>名前</th>
    <th>勤務開始</th>
    <th>勤務終了</th>
    <th>休憩時間</th>
    <th>勤務時間</th>
  </tr>
  @foreach($paginator as $usersWorkTime)
  <tr>
    <td>{{ $usersWorkTime['userName']}}</td>
    <td>{{ $usersWorkTime['workStartTime']->format('H:i:s')}}</td>
    <td>{{ $usersWorkTime['workFinishTime']->format('H:i:s')}}</td>
    <td>{{ $usersWorkTime['totalBreakTime']}}</td>
    <td>{{ $usersWorkTime['totalWorkTime']}}</td>
  </tr>
  @endforeach
</table>
<div class="link">
  {{$paginator->onEachSide(10)->links()}}
</div>
@endsection