<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class CertificateSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'file',
    ];

    public function training()
    {
        return $this->hasOne(Training::class);
    }

    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? null : Crypt::encryptString($value)
        );
    }

    // public function setFile($value)
    // {
    //     if (!is_null($value)) {
    //         $this->attributes['file'] = encrypt($value);
    //     } else {
    //         $this->attributes['file'] = null;
    //     }
    // }
}
