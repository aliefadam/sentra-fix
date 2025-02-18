<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuDetail extends Model
{
    protected $guarded = ['id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
