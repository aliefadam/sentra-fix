<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    /** @use HasFactory<\Database\Factories\ProductDetailFactory> */
    use HasFactory;

    protected $guarded = ["id"];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant1()
    {
        return $this->belongsTo(VariantDetail::class, 'variant1_id');
    }

    public function variant2()
    {
        return $this->belongsTo(VariantDetail::class, 'variant2_id');
    }
}
