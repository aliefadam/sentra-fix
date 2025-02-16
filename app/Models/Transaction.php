<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function shippingStatus()
    {
        return $this->hasMany(ShippingStatus::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
