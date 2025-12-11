<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class customer extends Model
{
    use HasFactory,SoftDeletes,Notifiable;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;



    public static function showById($id)
    {
        $customer = customer::find($id);

        return $customer;
    }//end method

    public static function addCustomer($data)
    {
        //store data to database 
        $customer = new customer;
        $customer->name = $data['name'];
        $customer->address = $data['address'];
        $customer->phone = $data['phone'];
        $customer->email = $data['email'];
        $customer->point = 0;
        $customer->save();

        return $customer;
    }//end method

    public static function updateCustomer($data)
    {
        $customer = customer::find($data['id']);
        $customer->name = $data['name'];
        $customer->address = $data['address'];
        $customer->phone = $data['phone'];
        $customer->email = $data['email'];
        $customer->save();

        return  $customer;
    }//end method

}//end class
