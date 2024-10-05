<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
        'amount',
        'total_amount',
        'type',
        'note',
        "created_at",
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', "id");
    }
}
