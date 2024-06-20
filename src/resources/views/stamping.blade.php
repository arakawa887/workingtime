@extends('layouts.app')

@section('css')
<link rel = "stylesheet" href = "{{ asset('css/stamping.css') }}">
@endsection



@section('content')


<div class = "stamps">
<h2>{{$username}}さんお疲れ様です！</h2>
@empty ($workTime)
<form class = "work-start" action = "/work-start" method = "post">
@csrf
<button class="work-start-button">勤務開始</button>
</form>

<form class = "work-finish" action = "/work-finish" method = "post">
@csrf
<button class = "finish-button" disabled>勤務終了</button>
</form>

<form class = "break-start" action = "/break-start" method = "post">
@csrf
<button class = "break-start-button" disabled>休憩開始</button>
</form>

<form class = "break-finish" action = "/break-finish" method = "post">
@csrf
<button class = "break-finish-button" disabled>休憩終了</button>
</form>
</div>
@else
@if($workTime->work_status_id == 1)
<div class = "stamps">
<form class = "work-start" action = "/work-start" method = "post">
@csrf
<button class = "work-start-button" disabled>勤務開始</button>
</form>

<form class = "work-finish" action="/work-finish" method="post">
@csrf
<button class = "finish-button">勤務終了</button>
</form>

<form class = "break-start" action = "/break-start" method="post">
@csrf
<button class = "break-start-button">休憩開始</button>
</form>

<form class = "break-finish" action = "/break-finish" method = "post">
@csrf
<button class = "break-finish-button" disabled>休憩終了</button>
</form>
</div>
@elseif($workTime->work_status_id == 3)
<div  class = "stamps">
<form class = "work-start" action = "/work-start" method = "post">
@csrf
<button class = "work-start-button" disabled>勤務開始</button>
</form>

<form class = "work-finish" action = "/work-finish" method = "post">
@csrf
<button class = "finish-button" disabled>勤務終了</button>
</form>

<form class = "break-start" action = "/break-start" method = "post">
@csrf
<button class = "break-start-button" disabled>休憩開始</button>
</form>

<form class = "break-finish" action = "/break-finish" method = "post">
@csrf
<button class = "break-finish-button">休憩終了</button>
</form>
</div>
@elseif($workTime->work_status_id == 4)
<div class = "stamps">
<form class = "work-start" action = "/work-start" method = "post">
@csrf
<button class = "work-start-button" disabled>勤務開始</button>
</form>

<form class = "work-finish" action = "/work-finish" method = "post">
@csrf
<button class = "finish-button">勤務終了</button>
</form>

<form class = "break-start" action = "/break-start" method = "post">
@csrf
<button class = "break-start-button">休憩開始</button>
</form>

<form class = "break-finish" action = "/break-finish" method = "post">
@csrf
<button class = "break-finish-button" disabled>休憩終了</button>
</form>
</div>
@elseif($workTime->work_status_id == 2)
<div class = "stamps">
<form class = "work-start" action = "/work-start" method = "post">
@csrf
<button class = "work-start-button">勤務開始</button>
</form>

<form class = "work-finish" action = "/work-finish" method = "post">
@csrf
<button class = "finish-button" disabled>勤務終了</button>
</form>

<form class = "break-start" action = "/break-start" method = "post">
@csrf
<button class = "break-start-button" disabled>休憩開始</button>
</form>

<form class = "break-finish" action = "/break-finish" method = "post">
@csrf
<button class = "break-finish-button" disabled>休憩終了</button>
</form>
</div>
@endif
@endempty
@endsection