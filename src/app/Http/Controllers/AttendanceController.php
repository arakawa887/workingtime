<?php

namespace App\Http\Controllers;
use App\Models\WorkTime;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
{
  $user = auth()->user();
  $username = $user->name;
  $today = Carbon::today();
  return view('stamping',['username' => $username],['today' => $today]);
}
public function store()
{
  return view('stamping');
}

public function work_start()
{
    $userId = auth()->id();

    WorkTime::create([
      'user_id' => $userId,
      'work_status_id' => 1,
  ]);
  return redirect('/');
}
public function work_finish()
{
    $userId = auth()->id();

    WorkTime::create([
      'user_id' => $userId,
      'work_status_id' => 2,
  ]);
  return redirect('/');
}
public function break_start()
{
    $userId = auth()->id();

    WorkTime::create([
      'user_id' => $userId,
      'work_status_id' => 3,
  ]);
  return redirect('/');
}
public function break_finish()
{
    $userId = auth()->id();

    WorkTime::create([
      'user_id' => $userId,
      'work_status_id' => 4,
  ]);
  return redirect('/');
}
public function date()
{
  $today = Carbon::today();
  $day = $today;
  $date = $today->copy()->format('Y-m-d');
  $yesterday = $day->copy()->subDay()->format('Y-m-d');
  $tomorrow = $day->copy()->addDays()->format('Y-m-d');
  $userIds = DB::select('SELECT DISTINCT user_id FROM work_times');
  $results = DB::table('users')
  ->join('work_times.id', 'users.id', '=', 'posts.user_id')
  ->whereDate('work_times.working_day', $date)
  ->select('users.name', 'work_times.work_stamp', 'work_times.work_status_id')
  ->orderBy('user_id')
  ->get()
  ->groupBy('user_id');
    return view('date', compact('day','data','yesterday','tomorrow','results'));
}
public function yesterday($day){
  $day = Carbon::parse($day);
  $yesterday = $day->copy()->subDay()->format('Y-m-d');
  $tomorrow = $day->copy()->addDays()->format('Y-m-d');
  $data = WorkTime::whereDate('working_day', $day)->get();
  return view('date', compact('day','data','yesterday','tomorrow'));
}
/*public function tomorrow($day){
  $day = Carbon::parse($day);
  $yesterday = $day->copy()->subDay()->format('Y-m-d');
  $tomorrow = $day->copy()->addDays()->format('Y-m-d');
  $data = WorkTime::whereDate('working_day', $day)->get();
  return view('date', compact('day','data','yesterday','tomorrow'));
}*/
}