<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class stock_in_detail extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'stock_in_details';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;

        public function stock_in_headers(): BelongsTo
    {
        return $this->belongsTo(stock_in_header::class,'stock_in_id');
    }
}//end class
