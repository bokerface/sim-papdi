<?php

namespace App\Http\Controllers\Midtrans;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function changeStatus(Request $request)
    {
        $json = json_decode($request->getContent());
        $signatureKey = (hash('sha512', $json->order_id . $json->status_code . $json->gross_amount . env('MIDTRANS_SERVER_KEY')));

        if ($signatureKey == $json->signature_key) {
            $transaction = $json->transaction_status;
            $type = $json->payment_type;
            $order_id = $json->order_id;
            $fraud = $json->fraud_status;
            $order = Order::findOrFail($order_id);
            if ($transaction == 'capture') {
                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        // TODO set payment status in merchant's database to 'Challenge by FDS'
                        // TODO merchant should decide whether this transaction is authorized or not in MAP

                        $order->update([
                            'status_order' => 'challenge',
                            'payment_date' => $json->transaction_time
                        ]);
                        echo "Transaction order_id: " . $order_id . " is challenged by FDS";
                    } else {
                        // TODO set payment status in merchant's database to 'Success'
                        $order->update([
                            'status_order' => 'success',
                            'payment_date' => $json->transaction_time
                        ]);
                        echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
                    }
                }
            } else if ($transaction == 'settlement') {
                // TODO set payment status in merchant's database to 'Settlement'
                $order->update([
                    'status_order' => 'settlement',
                    'payment_date' => $json->transaction_time
                ]);
                echo "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
            } else if ($transaction == 'pending') {
                // TODO set payment status in merchant's database to 'Pending'
                $order->update([
                    'status_order' => 'pending',
                    'payment_date' => $json->transaction_time
                ]);
                echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
            } else if ($transaction == 'deny') {
                // TODO set payment status in merchant's database to 'Denied'
                $order->update([
                    'status_order' => 'denied',
                    'payment_date' => $json->transaction_time
                ]);
                echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
            } else if ($transaction == 'expire') {
                // TODO set payment status in merchant's database to 'expire'
                $order->update([
                    'status_order' => 'expired',
                    'payment_date' => $json->transaction_time
                ]);
                echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
            } else if ($transaction == 'cancel') {
                // TODO set payment status in merchant's database to 'Denied'
                $order->update([
                    'status_order' => 'denied',
                    'payment_date' => $json->transaction_time
                ]);
                echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
            }
        }
    }
}
