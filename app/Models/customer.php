<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class customer extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;

        public static function showAll()
    {
        $customer = customer::all()->orderBy('created_at', 'desc');

        return $customer;
        
    }//end method show all

    public static function showById($id)
    {
        $customer = customer::find($id);

        return $customer;
    }//end method

    public static function addCustomer($data)
    {
        //store data to database 
        $customer = new customer;
        $customer->name = $data->name;
        $customer->address = $data->address;
        $customer->phone = $data->phone;
        $customer->email = $data->email;
        $customer->ic = $data->ic;
        $customer->point = 0;
        $customer->save();

        return $customer;
    }//end method

    public static function updateCustomer($data)
    {
        $customer = customer::find($id);
        $customer->name = $data->name;
        $customer->email = $data->email;
        $customer->phone = $data->phone;
        $customer->ic = $data->ic;
        $customer->address = $data->address;
        $customer->save();

        return true;
    }//end method

}//end class
