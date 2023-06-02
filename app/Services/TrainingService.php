<?php

namespace App\Services;

use App\Models\Training;
use App\Models\TrainingTrainer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TrainingService
{

    public static $training;

    public static function storeTraining($request)
    {
        DB::transaction(function () use ($request) {
            $training = Training::create(Arr::except($request, ['trainer_id', 'image']));

            $file = $request['image'];
            $fileName = $file->getClientOriginalName();
            $fileLocation = 'trainings/training_banner' . '/' . $training['id'] . '/';
            Storage::putFileAs($fileLocation, $file, $fileName);
            $training->update([
                'image' => $fileLocation . $fileName
            ]);

            TrainingTrainer::create([
                'training_id' => $training->id,
                'trainer_id' => $request['trainer_id'],
            ]);
        });
    }

    public static function getTrainingById($id)
    {
        static::$training = Training::findOrFail($id);
        return new static;
    }

    public static function updateTraining($request)
    {
        DB::transaction(function () use ($request) {
            $training = static::$training;

            $training->update(Arr::except($request, 'trainer_id'));

            $file = $request['image'];
            $fileName = $file->getClientOriginalName();
            $fileLocation = 'trainings/training_banner' . '/' . $training['id'] . '/';
            Storage::putFileAs($fileLocation, $file, $fileName);
            $training->update([
                'image' => $fileLocation . $fileName
            ]);

            $training->update([
                'image' => $fileLocation . $fileName
            ]);

            $training_trainer = TrainingTrainer::where([
                ['training_id', '=', $training->id],
                ['trainer_id', '=', $training->trainers()->first()->id]
            ])
                ->first();
            $training_trainer->update([
                'trainer_id' => $request['trainer_id']
            ]);
        });
    }

    public static function fetch()
    {
        return static::$training;
    }

    public static function trainingIndex()
    {
    }
}
