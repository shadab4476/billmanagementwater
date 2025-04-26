<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'rate',
        'date',
        'note',
        'shop_id',
        'user_id',
    ];

    public function shops()
    {
        return $this->belongsTo(Shop::class, "shop_id", "id");
    }
}
