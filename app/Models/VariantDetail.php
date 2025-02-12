<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantDetail extends Model
{
    /** @use HasFactory<\Database\Factories\VariantDetailFactory> */
    use HasFactory;

    protected $guarded = ["id"];

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
}
