<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkTime extends Model
{
    use HasFactory;
    //protected $table = 'work_times';
    protected $fillable = ['user_id', 'work_status_id'];

    public function category()
{
    return $this->belongsTo(User::class);
    return $this->belongsTo(WorkStatus::class);
}
}
