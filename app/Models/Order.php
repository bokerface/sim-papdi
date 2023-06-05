<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'user_id',
        'order_date',
        'payment_date',
        'status_order',
        'transaction_id'
    ];

    public function orderParticipants()
    {
        return $this->hasMany(OrderParticipant::class);
    }
}
