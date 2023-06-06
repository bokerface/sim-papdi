<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderParticipant;
use App\Models\Participant;
use App\Models\Training;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public static function createOrder($request, $userId)
    {
        DB::transaction(function () use ($request, $userId) {
            $order = Order::create([
                'training_id' => $request['training_id'],
                'user_id' => $userId,
                'order_date' => now(),
            ]);

            $training_participants = Arr::except($request, ['training_id']);

            foreach ($training_participants['email'] as $key => $value) {

                $participant = Participant::where([['user_id', '=', $userId], ['email', '=', $value]])->first();

                // dump($participant);

                if (!$participant) {
                    $participant = Participant::create([
                        'user_id' => $userId,
                        'fullname' => $training_participants['fullname'][$key],
                        'email' => $value
                    ]);
                }

                OrderParticipant::create([
                    'participant_id' => $participant->id,
                    'order_id' => $order->id
                ]);
            }
            // dd($training_participants);
        });
    }

    public static function detailOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        $training = Training::find($order->training_id);

        $trainingPrice = '';
        if (time() < $training->earlybird_end) {
            $trainingPrice = $training->price_earlybird;
        } elseif (time() == $training->start_date) {
            $trainingPrice = $training->price_onsite;
        } else {
            $trainingPrice = $training->price_normal;
        }

        $totalPrice = $trainingPrice * $order->orderParticipants()->count();

        $participants = [];
        foreach ($order->orderParticipants()->get() as $data) {
            $participants[] = [
                'fullname' => $data->participant->fullname,
                'email' => $data->participant->email,
            ];
        }

        $data = [
            'order' => $order,
            'training' => $training,
            'trainingPrice' => $trainingPrice,
            'numberOfParticipants' => $order->orderParticipants()->count(),
            'participants' => $participants,
            'totalPrice' => $totalPrice
        ];

        return $data;
    }
}
