<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class item_redeem extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'item_redeems';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;
}
