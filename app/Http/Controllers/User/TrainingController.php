<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParticipantRequest;
use App\Services\TrainingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    public function show($id): View
    {
        $training = TrainingService::getTrainingById($id)->fetch();
        return view('user.pages.training.detail')
            ->with(compact('training'));
    }

    public function checkout($id, Request $request)
    {
        $request = $request->validate(
            ['q' => 'numeric']
        );

        $participant = $request['q'];
        $training = TrainingService::getTrainingById($id)->fetch();
        $price = TrainingService::getTrainingById($id)->trainingPrice();
        $totalPrice = $price * $request['q'];

        // dd(TrainingService::getTrainingById($id)->trainingPrice());
        return view('user.pages.training.checkout')
            ->with([
                'participant' => $participant,
                'training' => $training,
                'price' => $price,
                'totalPrice' => $totalPrice
            ]);
    }
}
