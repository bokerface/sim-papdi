<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipantRequest;
use App\Models\Order;
use App\Models\Training;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function show($id)
    {

        $trainingId = Order::find($id)->training_id;
        return view('user.pages.order.detail')
            ->with([
                'training' => Training::find($trainingId)
            ]);
    }

    public function placeOrder(StoreParticipantRequest $request)
    {
        $userId = Auth::id();
        OrderService::createOrder($request->validated(), $userId);
    }
}
