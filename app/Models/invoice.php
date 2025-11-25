<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class invoice extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;

        public function invoice_detail(): HasMany
    {
        return $this->hasMany(invoice_detail::class,'inv_id');
    }
}
