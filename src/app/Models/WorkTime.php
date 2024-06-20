<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WorkTime extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'work_status_id','working_day'];

    public function user()
{
    return $this->belongsTo(User::class);
}
    public function workStatus()
{
    return $this->belongsTo(WorkStatus::class);
}
    public function usersWorkTime()
{
    $today = Carbon::today();
    $workStarts = WorkTime::with('User')
    ->where([['working_day', '=',$today],['work_status_id' ,'=', '2']])
    ->orderby('user_id', 'asc')
    ->get();
    $usersWorkTimes = [];
    foreach($workStarts as $user){
        $workStartTime = 0;
        $workFinishTime = 0;
        $breakStartTime = 0;
        $breakFinishTime = 0;
        $totalBreakTime = 0;
        $totalWorkTime = 0;
        $workTimeCalculation = WorkTime::with('User')
        ->where([['working_day' , '=' , $today],['user_id' , '=' , $user->user_id]])
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
            'totalBreakTime' => $totalBreakTimeHour . ":" . $totalBreakTimeMinute . ":". $totalBreakTimeSecond,
            'totalWorkTime' => $totalWorkTimeHour . ":" . $totalWorkTimeMinute . ":". $totalWorkTimeSecond,
        ];
    }
return $usersWorkTimes;
}
    public function changeDateUsersWorkTime($day){
        $today = Carbon::create($day);
        $workStarts = WorkTime::with('User')
        ->where([['working_day', '=',$today],['work_status_id' ,'=', '2']])
        ->orderby('user_id', 'asc')
        ->get();
        $usersWorkTimes = [];
        foreach($workStarts as $user){
            $workStartTime = 0;
            $workFinishTime = 0;
            $breakStartTime = 0;
            $breakFinishTime = 0;
            $totalBreakTime = 0;
            $totalWorkTime = 0;
            $workTimeCalculation = WorkTime::with('User')
            ->where([['working_day' , '=' , $today],['user_id' , '=' , $user->user_id]])
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
                'totalBreakTime' => $totalBreakTimeHour . ":" . $totalBreakTimeMinute . ":" . $totalBreakTimeSecond,
                'totalWorkTime' => $totalWorkTimeHour . ":" . $totalWorkTimeMinute . ":" . $totalWorkTimeSecond,
            ];
        }
        return $usersWorkTimes;
    }
}
