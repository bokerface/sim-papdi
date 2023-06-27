<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Training;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        return view('user.certificate.index');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $training = Training::find($order->training_id);
        return view('document.certificate', compact('order', 'training'));

        $pdf = PDF::loadView('document.certificate', compact('order', 'training'));

        return $pdf->download('cert.pdf');
    }

    public function download()
    {
    }
}
