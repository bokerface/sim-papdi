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

    protected $casts = [
        'order_date' => 'date',
    ];

    public function orderParticipants()
    {
        return $this->hasMany(OrderParticipant::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function getStatusAttribute()
    {
        if ($this->status_order == "Lunas") {
            return "Lunas";
        }

        if (Training::find($this->training_id)->start_date < time()) {
            return "Expired";
        }

        return "Pending";
    }
}
