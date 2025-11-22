<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class company extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'companies';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;

    public static function addCompany($id)
    {
        $company = new company;
        $company->user_id = $id;
        $company->save();

        return $company;
    }//end method add company

    public static function myCompany()
    {
        $company = company::where('user_id',auth()->user()->id)->first();

        return $company;
        
    }//end method my comapny

}//end class
