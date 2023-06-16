<?php

namespace App\View\Components\User;

use App\Models\Order;
use Illuminate\View\Component;

class OrderStatus extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $status;
    public $statusClass;
    public function __construct($id)
    {
        $order = Order::find($id);

        if ($order->payment_method->name == 'Midtrans') {
            if ($order->status_order == 'success') {
                $this->status = 'Success';
                $this->statusClass = 'bg-success';
            } elseif ($order->status_order ==  'settlement') {
                $this->status = 'Settlement';
                $this->statusClass = 'bg-success';
            } elseif ($order->status_order == 'pending') {
                $this->status = 'Pending';
                $this->statusClass = 'bg-info';
            } elseif ($order->status_order == 'denied') {
                $this->status = 'Denied';
                $this->statusClass = 'bg-danger';
            } elseif ($order->status_order == 'expired') {
                $this->status = 'Expired';
                $this->statusClass = 'bg-warning';
            } else {
                $this->status = 'Menunggu Pembayaran';
                $this->statusClass = 'bg-secondary';
            }
        } else {
            if ($order->status == 'Lunas') {
                $this->status = 'Lunas';
                $this->statusClass = 'bg-success';
            } elseif ($order->status == 'Expired') {
                $this->status = 'Expired';
                $this->statusClass = 'bg-warning';
            } else {
                $this->status = 'Menunggu Pembayaran';
                $this->statusClass = 'bg-info';
            }
        }

        // $this->status = $order->payment_method->name;
        // $this->statusClass = 'bg-dark';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.order-status');
    }
}
