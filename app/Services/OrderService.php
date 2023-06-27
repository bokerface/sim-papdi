<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderParticipant;
use App\Models\Participant;
use App\Models\Training;
use Error;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;

class OrderService
{

    public static $order;

    public static function orderIndex($user_id = null, $request = null)
    {
        return Order::when($user_id != null, function ($q) use ($user_id) {
            $q->where('user_id', '=', $user_id);
        })
            ->paginate(10)
            ->withQueryString();
    }

    public static function createOrder($request, $userId)
    {
        DB::transaction(function () use ($request, $userId) {
            $order = Order::create([
                'training_id' => $request['training_id'],
                'user_id' => $userId,
                'order_date' => now(),
                'payment_method' => $request['payment_method']
            ]);

            $training_participants = Arr::except($request, ['training_id']);

            foreach ($training_participants['email'] as $key => $value) {

                $participant = Participant::where([['user_id', '=', $userId], ['email', '=', $value]])->first();

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

            static::$order = $order->id;
        });
        return static::$order;
    }

    public static function detailOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        $training = Training::find($order->training_id);

        if ($order->payment_method == "Transfer") {
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

            static::$order = $data;
            return new static;
        }

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
            'totalPrice' => $totalPrice,
        ];

        static::$order = $data;
        return new static;
    }

    public static function confirmOrderPayment($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status != "Lunas" && $order->status != "Expired") {
            $order->update([
                'status_order' => "Lunas",
                'payment_date' => now()
            ]);
        }
    }

    public static function fetch()
    {
        return static::$order;
    }

    public static function checkoutData()
    {
        $order = static::$order;

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');

        // Required
        $transaction_details = array(
            'order_id' => $order['order']['id'],
            'gross_amount' => $order['totalPrice'], // no decimal allowed for creditcard
        );

        // Fill SNAP API parameter
        $params = array(
            'transaction_details' => $transaction_details,
            'callbacks' => [
                // 'finish' => 'orders/' . $order['order']['order_id']
                'finish' => "https://78bb-2001-448a-4049-21b1-a0b1-1efb-6937-e324.ngrok-free.app/" . 'orders/' . $order['order']['order_id']
            ]
        );

        return $params;
    }

    public static function orderCertificate($id)
    {
    }
}
