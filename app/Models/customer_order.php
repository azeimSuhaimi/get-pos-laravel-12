<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class customer_order extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'customer_orders';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;

    public static function customerOrderAllList($id)
    {
        $customer_order = customer_order::where('user_id',$id)->orderBy('created_at', 'desc')->get();

        return $customer_order;
    }//end method

    public static function customerOrderListByDate($date)
    {
        $customer_order = customer_order::where('date_month', $date)->orderBy('created_at', 'desc')->get();

        return $customer_order;
    }//end method

    public static function addCustomerOrder($data)
    {
        $date_month = Carbon::now()->format('Y-m');

        //store data to database 
        $customer_order = new customer_order;
        $customer_order->name = $data->name;
        $customer_order->email = $data->email;
        $customer_order->phone = $data->phone;
        $customer_order->item = $data->item;
        $customer_order->remark = $data->remark;
        $customer_order->date_month =  $date_month;
        $customer_order->save();

        return $customer_order;
    }//end method

    public static function updateContact($id)
    {
        $customer_order = customer_order::find($id);
    
        $customer_order->contact = true;
        $customer_order->save();

        return true;
    }//end method

    public static function updatePickup($id)
    {
        $customer_order = customer_order::find($id);
    
        $customer_order->status = true;
        $customer_order->contact = true;
        $customer_order->save();

        return true;
    }//end method

    public static function deleteOrder($id)
    {
        $customer_order = customer_order::find($id);
        $customer_order->delete();
        return true;
    }//end method
}//end class customer order
