<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'payment_method',
        'user_id',
        'order_date',
        'payment_date',
        'status_order',
        'transaction_id',
    ];

    protected $casts = [
        'payment_method' => PaymentMethodEnum::class,
        'order_date' => 'date',
    ];

    protected $appends = ['status'];

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

        if (Carbon::now()->gt(Training::find($this->training_id)->start_date)) {
            return "Expired";
        }

        return "Pending";
    }
}
