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

    public function products_variant_1()
    {
        return $this->hasMany(ProductDetail::class, "variant1_id");
    }

    public function products_variant_2()
    {
        return $this->hasMany(ProductDetail::class, "variant2_id");
    }
}
