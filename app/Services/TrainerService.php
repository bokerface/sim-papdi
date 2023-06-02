<?php

namespace App\Services;

use App\Models\Trainer;
use Illuminate\Support\Facades\DB;

class TrainerService
{
    public static function storeTrainer($request)
    {
        DB::transaction(function () use ($request) {
            Trainer::create($request);
        });
    }
}
