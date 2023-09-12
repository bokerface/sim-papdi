<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrgentParticipant extends Model
{
    use HasFactory;
    protected $fillable = [
        'training_id',
        'fullname',
        'email',
        'agency'
    ];
}
