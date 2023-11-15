<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkout extends Model
{

    protected $fillable=[

        'name',
        'phone',
        'total_product',
        'total_price',
        'email',
        'status',
    ];
    use HasFactory;
}
