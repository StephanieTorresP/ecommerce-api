<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_amount', 'status'];

    // Relación inversa: Una orden pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Una orden contiene muchos artículos
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Una orden tiene un único pago
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
