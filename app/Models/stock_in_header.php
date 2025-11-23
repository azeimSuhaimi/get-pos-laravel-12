<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class stock_in_header extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'stock_in_headers';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;
}//end class 
