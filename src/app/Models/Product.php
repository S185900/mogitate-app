<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function season()
    {
        return $this->belongsToMany(Season::class, 'products_seasons', 'product_id', 'season_id');
    }
}
