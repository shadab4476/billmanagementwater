<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'date',
        'amount',
        'type',
        'note',
    ];
    public function shops()
    {
        return $this->belongsTo(Shop::class, 'shop_id', "id");
    }
}
