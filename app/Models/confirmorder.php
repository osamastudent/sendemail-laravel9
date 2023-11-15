<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class confirmorder extends Model
{
    protected $fillable = [
        'user_name',
        'user_phone',
        'user_email',
        'pro_name',
        'pro_price',
        'pro_quantity',
        'total_price',
        'status',

    ];
    use HasFactory;
}
