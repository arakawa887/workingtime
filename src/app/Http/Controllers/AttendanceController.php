<?php

namespace App\Http\Controllers;

use App\Models\WorkTime;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
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
    return view('stamping',['username' => $username,'today' => $today,'workTime' => $workTime]);
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
  $tomorrow = $day->copy()->addDays()->format('Y-m-d');
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
public function changeDay($day,Request $request){
  $today = Carbon::create($day);
  $day = $today;
  $date = $day->copy()->format('Y-m-d');
  $yesterday = $day->copy()->subDay()->format('Y-m-d');
  $tomorrow = $day->copy()->addDays()->format('Y-m-d');
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