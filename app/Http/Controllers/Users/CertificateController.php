<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\CertificateSetting;
use App\Models\Order;
use App\Models\Training;
use App\Models\UrgentParticipant;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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

    public function download($training_id, $participant_email)
    {
        // $order = Order::findOrFail($id);
        $training = Training::find($training_id);
        $participant = UrgentParticipant::where([
            ['training_id', '=', $training_id],
            ['email', '=', $participant_email]
        ])->first();
        $filePath = CertificateSetting::where('training_id', '=', $training->id)->firstOrFail()->file;

        if ($filePath == null) {
            abort(404);
        }

        $background = route('uni.certificate_background_image') . '?q=' . $filePath;

        return view('document.new-certificate', compact(['participant', 'training', 'background']));

        $pdf = PDF::loadView('document.certificate', compact(['participant', 'training', 'background']));

        return $pdf->download('cert.pdf');
    }
}
