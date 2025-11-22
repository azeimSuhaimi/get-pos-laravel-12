<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class customer_item_redeem extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'customer_item_redeems';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;

    public static function addItemRedeem($data)
    {

        $customer_item_redeem = new customer_item_redeem;
        $customer_item_redeem->name = $data;
        $customer_item_redeem->description = $data;
        $customer_item_redeem->point = $data;
        $customer_item_redeem->cust_id = $data;
        $customer_item_redeem->save();

        return $customer_item_redeem;
        
    }//end method add item redeem customer

    public static function showAll()
    {
        $customer_item_redeem = customer_item_redeem::all()->orderBy('created_at', 'desc');

        return $customer_item_redeem;
        
    }//end method show all

    public static function redeemById($id)
    {
        $customer_item_redeem = customer_item_redeem::where('cust_id',$id)->orderBy('created_at', 'desc')->get();

        return $customer_item_redeem;
        
    }//end method customer_item_redeem
}//end class
