<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\StoreParticipantRequest;
use App\Models\Order;
use App\Models\Training;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Error;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Throwable;

class OrderController extends Controller
{
    public function index()
    {
        return view('user.pages.order.index')
            ->with([
                'orders' => OrderService::orderIndex(Auth::id())
            ]);
    }

    public function show($id)
    {
        if (Auth::id() != Order::findOrFail($id)->user_id) {
            abort(403);
        }

        $order = OrderService::detailOrder($id)->fetch();

        if ($order['order']['payment_method']->value == 'Transfer') {
            return view('user.pages.order.detail')
                ->with([
                    'data' => $order
                ]);
        }

        if ($order['order']['payment_method']->value == 'Midtrans') {
            return view('user.pages.order.detail-midtrans')
                ->with([
                    'data' => $order,
                    // 'midtransClientKey' => "SB-Mid-client-NUHDTW6uipcvE7sz"
                ]);
        }
    }

    public function placeOrder(StoreParticipantRequest $request)
    {
        $userId = Auth::id();
        $orderId = OrderService::createOrder($request->validated(), $userId);
        return redirect()->to(route('user.detail_order', $orderId));
    }

    public function midtransCheckoutProcess($id)
    {
        $params = OrderService::detailOrder($id)->checkoutData();
        try {
            $paymentUrl = Snap::createTransaction($params)->redirect_url;
            return redirect()->to($paymentUrl);
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Tidak bisa melakukan pembayaran.');
        }
    }

    function printExampleWarningMessage()
    {
        if (strpos(Config::$serverKey, 'your ') != false) {
            echo "<code>";
            echo "<h4>Please set your server key from sandbox</h4>";
            echo "In file: " . __FILE__;
            echo "<br>";
            echo "<br>";
            echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
            die();
        }
    }
}
