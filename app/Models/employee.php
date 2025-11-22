<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class employee extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;

    public static function addEmployee($validated,$id)
    {
        $now = Carbon::now();// get date today
        //store data to database 
        $employee = new employee;
        $employee->gender = $validated['gender'];
        $employee->birthday = $validated['birthday'];
        $employee->ic = $validated['ic'];
        $employee->work_id = $validated['work_id'];
        $employee->address = $validated['address'];
        $employee->address2 = $validated['address2'];
        $employee->position = $validated['position'];
        $employee->date_register = $now;
        $employee->user_id = $id;
        $employee->save();

        return $employee;
    }//end method add employee
}//end class
