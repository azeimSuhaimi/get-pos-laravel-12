<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class stock_in_header extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'stock_in_headers';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;

    public function stock_in_details(): HasMany
    {
        return $this->hasMany(stock_in_detail::class,'stock_in_id');
    }
}//end class 
