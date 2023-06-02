<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingTrainer extends Model
{
    use HasFactory;

    protected $table = 'training_trainer';

    protected $fillable = [
        'training_id',
        'trainer_id',
    ];
}
