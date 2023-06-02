<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\TrainingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
        return view('user.pages.training.checkout');
        dd($request->q);
    }
}
