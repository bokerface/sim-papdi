<?php

namespace App\Models;

use App\Enums\TrainingTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Training extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'price_earlybird',
        'price_normal',
        'price_onsite',
        'place',
        'type',
        'description',
        'quota',
        'image'
    ];

    protected $cast = [
        'type' => TrainingTypeEnum::class
    ];

    public function trainers()
    {
        return $this->belongsToMany(Trainer::class, 'training_trainer');
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Crypt::encryptString($value)
        );
    }
}
