<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderParticipant extends Model
{
    use HasFactory;

    protected $table = 'order_participant';

    protected $fillable = [
        'participant_id',
        'order_id'
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
