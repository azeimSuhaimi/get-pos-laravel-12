<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class customer_purchase_detail extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'customer_purchase_details';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;

}//end class
