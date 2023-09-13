<?php

namespace App\Services;

use App\Models\Training;
use App\Models\TrainingTrainer;
use App\Models\UrgentParticipant;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TrainingService
{

    public static $training;

    public static function storeTraining($request)
    {
        DB::transaction(function () use ($request) {

            // dd($request);
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

            if (array_key_exists('image', $request)) {
                $file = $request['image'];
                $fileName = $file->getClientOriginalName();
                $fileLocation = 'trainings/training_banner' . '/' . $training['id'] . '/';
                Storage::putFileAs($fileLocation, $file, $fileName);
                $training->update([
                    'image' => $fileLocation . $fileName
                ]);

                // $training->update([
                //     'image' => $fileLocation . $fileName
                // ]);
            }

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

    public static function trainingPrice()
    {
        $training = static::$training;

        // dd($training->earlybird_end);
        if (time() < $training->earlybird_end) {
            return $training->price_earlybird;
        }

        if (time() == $training->start_date) {
            return $training->price_onsite;
        }

        return $training->price_normal;
    }

    public static function storeUrgentTrainingParticipant($request)
    {
        DB::transaction(function () use ($request) {
            UrgentParticipant::create($request);
        });
    }

    public static function deleteUrgentTrainingParticipant($participant_id)
    {
        DB::transaction(function () use ($participant_id) {
            UrgentParticipant::find($participant_id)->delete();
        });
    }

    public static function trainingIndex()
    {
    }
}
