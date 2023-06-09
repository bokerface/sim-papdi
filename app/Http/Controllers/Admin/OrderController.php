<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.pages.order.index')
            ->with(['orders' => OrderService::orderIndex()]);
    }

    public function show($id)
    {
        return view('admin.pages.order.detail')
            ->with([
                'data' => OrderService::detailOrder($id)
            ]);
    }

    public function confirmPayment($id)
    {
        OrderService::confirmOrderPayment($id);
        return redirect()->back();
    }
}
