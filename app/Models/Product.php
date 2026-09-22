<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Definimos qué columnas se pueden llenar desde el código
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock'
    ];
}
