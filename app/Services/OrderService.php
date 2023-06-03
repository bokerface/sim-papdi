<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderPartcipant;
use App\Models\Participant;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public static function createOrder($request, $userId)
    {
        DB::transaction(function () use ($request, $userId) {
            $order = Order::create([
                'training_id' => $request['training_id'],
                'user_id' => $request['training_id'],
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

                OrderPartcipant::create([
                    'participant_id' => $participant->id,
                    'order_id' => $order->id
                ]);
            }
            // dd($training_participants);
        });
    }
}
