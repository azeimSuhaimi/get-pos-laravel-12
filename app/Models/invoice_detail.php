<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class invoice_detail extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'invoice_details';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(invoice::class,'inv_id');
    }
}
