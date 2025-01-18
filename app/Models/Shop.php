<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected  $fillable = [
        "id",
        "user_id",
        "shop_name",
        "shop_address",
        "shop_image",
        "status",
        "shop_description",
    ];

    public function users()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
