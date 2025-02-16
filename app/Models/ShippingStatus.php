<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingStatus extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingStatusFactory> */
    use HasFactory;


    protected $guarded = ['id'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
