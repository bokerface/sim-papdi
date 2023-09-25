<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UrgentParticipant;
use Illuminate\Http\Request;

class SelectCertificateController extends Controller
{
    public function index()
    {
        return view('user.certificate.check-certificate');
    }

    public function checkCertificate(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email:filter']
        ]);

        $participant = UrgentParticipant::where('email', '=', $validated['email']);

        if ($participant->count() > 0) {
            $certificates = $participant->select(
                'urgent_participants.*',
                'trainings.name as training_name',
                'trainings.id as t_training_id',
            )
                ->leftJoin('trainings', 'trainings.id', '=', 'urgent_participants.training_id')
                // ->leftJoin('certificate_settings', 'certificate_settings.training_id', '=', 'trainings.id')
                ->get();
            return view('user.certificate.certificate-list')
                ->with(compact('certificates'));
        }

        return redirect()->back()->withErrors(['email_doesnt_exists' => 'Email yang anda masukkan tidak terdaftar dalam pelatihan manapun.']);
    }
}
