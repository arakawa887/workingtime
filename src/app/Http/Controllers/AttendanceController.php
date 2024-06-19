<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkTime;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
  {
    $user = auth()->user();
    $username = $user->name;
    $today = Carbon::today()->format('Y-m-d');
    $workTime = WorkTime::where('user_id', $user->id)
    ->whereDate('working_day', $today)
    ->orderBy('created_at', 'desc')
    ->first();
    //dd($workTime);
    
    return view('stamping',['username' => $username,'today' => $today,'workTime' => $workTime]);
  }
public function store()
{
  return view('stamping');
}

public function work_start()
{
    $userId = auth()->id();
    $today = Carbon::today()->format('Y-m-d');
    WorkTime::create([
      'user_id' => $userId,
      'work_status_id' => 1,
      'working_day' => $today
  ]);
  return redirect('/');
}
public function work_finish()
{
    $userId = auth()->id();
    $today = Carbon::today()->format('Y-m-d');
    WorkTime::create([
      'user_id' => $userId,
      'work_status_id' => 2,
      'working_day' => $today
  ]);
  return redirect('/');
}
public function break_start()
{
    $userId = auth()->id();
    $today = Carbon::today()->format('Y-m-d');
    WorkTime::create([
      'user_id' => $userId,
      'work_status_id' => 3,
      'working_day' => $today
  ]);
  return redirect('/');
}
public function break_finish()
{
    $userId = auth()->id();
    $today = Carbon::today()->format('Y-m-d');
    WorkTime::create([
      'user_id' => $userId,
      'work_status_id' => 4,
      'working_day' => $today
  ]);
  return redirect('/');
}
public function date(Request $request)
{
  $today = Carbon::today();
  $day = $today;
  $date = $today->copy()->format('Y-m-d');
  $yesterday = $day->copy()->subDay()->format('Y-m-d');
  $tomorrow = $day->copy()->addDays()->format('Y-m-d');/*
  //$users = User()
  $workStarts = WorkTime::with('User')
  ->where([['working_day', '=',$today],['work_status_id' ,'=', '4']])
  ->orderby('user_id', 'asc')
  ->get();
  $usersWorkTimes = [];
  //dd($workStarts);
foreach($workStarts as $user){
  $workStartTime = 0;
  $workFinishTime = 0;
  $breakStartTime = 0;
  $breakFinishTime = 0;
  $totalBreakTime = 0;
  $totalWorkTime = 0;
  $workTimeCalculation = WorkTime::with('User')
  ->where([['working_day', '=',$today],['user_id' ,'=', $user->user_id]])
  ->get();
  foreach($workTimeCalculation as $workSeparator){
    if($workSeparator->work_status_id == 1){
      $workStartTime = Carbon::create($workSeparator->work_stamp);
    }elseif($workSeparator->work_status_id == 2){
      $workFinishTime = Carbon::create($workSeparator->work_stamp);
      $totalWorkTime = $workStartTime->diffInSeconds($workFinishTime) - $totalBreakTime;
    }elseif($workSeparator->work_status_id == 3){
      $breakStartTime = Carbon::create($workSeparator->work_stamp);
    }elseif($workSeparator->work_status_id == 4){
      $breakFinishTime = Carbon::create($workSeparator->work_stamp);
      $totalBreakTime = $totalBreakTime + $breakStartTime->diffInSeconds($breakFinishTime);
    }

  }
  $totalWorkTimeHour = floor($totalWorkTime/3600);
  $totalWorkTimeMinute = floor(($totalWorkTime%3600)/60);
  $totalWorkTimeSecond = $totalWorkTime%60;

  $totalBreakTimeHour = floor($totalBreakTime/3600);
  $totalBreakTimeMinute = floor(($totalBreakTime%3600)/60);
  $totalBreakTimeSecond = $totalBreakTime%60;
  $usersWorkTimes[] = [
    'userName' => $user->user->name,
    'workStartTime' => $workStartTime,
    'workFinishTime' => $workFinishTime,
    'totalBreakTime' => $totalBreakTimeHour .":". $totalBreakTimeMinute. ":".$totalBreakTimeSecond,
    'totalWorkTime' => $totalWorkTimeHour .":". $totalWorkTimeMinute. ":".$totalWorkTimeSecond,
  ];
  //dd($usersWorkTimes);
}*/
  $workTime = new WorkTime;
  $usersWorkTimes = $workTime->usersWorkTime();
  $usersWorkTimes = collect($usersWorkTimes);
  $perPage = 5;
  $currentPage = LengthAwarePaginator::resolveCurrentPage();
  $currentPageItems = $usersWorkTimes->slice(($currentPage - 1) * $perPage, $perPage)->values();
  $paginator = new LengthAwarePaginator(
    $currentPageItems,
    $usersWorkTimes->count(),
    $perPage,
    $currentPage,
    ['path' => $request->url(), 'query' => $request->query()]
);
    return view('date', compact('day','yesterday','tomorrow','paginator'));
}
public function yesterday($day,Request $request){
  $today = Carbon::create($day);
  $day = $today;
  $date = $day->copy()->format('Y-m-d');
  $yesterday = $day->copy()->subDay()->format('Y-m-d');
  $tomorrow = $day->copy()->addDays()->format('Y-m-d');
  /*$workStarts = WorkTime::with('User')
  ->where([['working_day', '=',$today],['work_status_id' ,'=', '4']])
  ->orderby('user_id', 'asc')
  ->get();
  $usersWorkTimes = [];
  //dd($workStarts);
foreach($workStarts as $user){
  $workStartTime = 0;
  $workFinishTime = 0;
  $breakStartTime = 0;
  $breakFinishTime = 0;
  $totalBreakTime = 0;
  $totalWorkTime = 0;
  $workTimeCalculation = WorkTime::with('User')
  ->where([['working_day', '=',$today],['user_id' ,'=', $user->user_id]])
  ->get();
  foreach($workTimeCalculation as $workSeparator){
    if($workSeparator->work_status_id == 1){
      $workStartTime = Carbon::create($workSeparator->work_stamp);
    }elseif($workSeparator->work_status_id == 2){
      $workFinishTime = Carbon::create($workSeparator->work_stamp);
      $totalWorkTime = $workStartTime->diffInSeconds($workFinishTime) - $totalBreakTime;
    }elseif($workSeparator->work_status_id == 3){
      $breakStartTime = Carbon::create($workSeparator->work_stamp);
    }elseif($workSeparator->work_status_id == 4){
      $breakFinishTime = Carbon::create($workSeparator->work_stamp);
      $totalBreakTime = $totalBreakTime + $breakStartTime->diffInSeconds($breakFinishTime);
    }

  }
  $totalWorkTimeHour = floor($totalWorkTime/3600);
  $totalWorkTimeMinute = floor(($totalWorkTime%3600)/60);
  $totalWorkTimeSecond = $totalWorkTime%60;

  $totalBreakTimeHour = floor($totalBreakTime/3600);
  $totalBreakTimeMinute = floor(($totalBreakTime%3600)/60);
  $totalBreakTimeSecond = $totalBreakTime%60;
  $usersWorkTimes[] = [
    'userName' => $user->user->name,
    'workStartTime' => $workStartTime,
    'workFinishTime' => $workFinishTime,
    'totalBreakTime' => $totalBreakTimeHour .":". $totalBreakTimeMinute. ":".$totalBreakTimeSecond,
    'totalWorkTime' => $totalWorkTimeHour .":". $totalWorkTimeMinute. ":".$totalWorkTimeSecond,
  ];
  //dd($usersWorkTimes);
}*/
$workTime = new WorkTime;
$usersWorkTimes = $workTime->changeDateUsersWorkTime($day);
$usersWorkTimes = collect($usersWorkTimes);
$perPage = 5;
$currentPage = LengthAwarePaginator::resolveCurrentPage();
$currentPageItems = $usersWorkTimes->slice(($currentPage - 1) * $perPage, $perPage)->values();
$paginator = new LengthAwarePaginator(
  $currentPageItems,
  $usersWorkTimes->count(),
  $perPage,
  $currentPage,
  ['path' => $request->url(), 'query' => $request->query()]
);
  return view('date', compact('day','paginator','yesterday','tomorrow'));
}

}