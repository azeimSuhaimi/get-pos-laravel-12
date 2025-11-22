<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class activity_log extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;

    public static function addActivity($activity)
    {
        $now = Carbon::now();
        $date = $now->format('d-m-Y');
        $time = $now->format('H:i:s');
        $unixTimestamp = Carbon::now()->timestamp;

        $activity_log = new activity_log;
        $activity_log->activity = $activity;
        $activity_log->date = $date;
        $activity_log->time = $time;
        $activity_log->unix_time = $unixTimestamp;
        $activity_log->user_id = auth()->user()->id;
        $activity_log->save();

        return true;
        
    }//end method add activity

    public static function showAll()
    {
        $activity_log = activity_log::all()->orderBy('created_at', 'desc');

        return $activity_log;
        
    }//end method show all

    public static function myActivity()
    {
        $activity_log = activity_log::where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return $activity_log;
        
    }//end method my activity

    public static function activityById($id)
    {
        $activity_log = activity_log::where('user_id',$id)->orderBy('created_at', 'desc')->get();

        return $activity_log;
        
    }//end method my activity

}//end class
