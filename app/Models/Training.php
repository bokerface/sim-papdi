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
        'category_id',
        'name',
        'start_date',
        'end_date',
        'price_earlybird',
        'earlybird_end',
        'price_normal',
        'price_onsite',
        'place',
        'type',
        'description',
        'quota',
        'image'
    ];

    protected $casts = [
        'type' => TrainingTypeEnum::class,
        'start_date' => 'datetime',
        'end_date' => 'datetime',
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

    public function certificateSetting()
    {
        return $this->hasOne(CertificateSetting::class);
    }
}
