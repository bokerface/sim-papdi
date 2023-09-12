<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCertificateSettingsRequest;
use App\Models\Certificate;
use App\Models\CertificateSetting;
use App\Models\Order;
use App\Models\OrderParticipant;
use App\Models\Training;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index()
    {
    }

    public function settingIndex()
    {
        $trainings = Training::all();
        return view('admin.pages.certificate.setting-index')
            ->with(compact('trainings'));
    }

    public function settingDetail($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.pages.certificate.setting-detail')
            ->with(compact('order'));
    }

    public function preview(Request $request, $id)
    {
        $request->validate([
            'background' => ['required', 'image', 'mimes:jpg,png', 'max:512'],
            'template' => ['required', 'string'],
        ]);

        $order = Order::findOrFail($id);
        $participants = OrderParticipant::where('order_id', '=', $order->id)->get();

        $file = $request->background;
        $fileName = $file->getClientOriginalName();
        $fileLocation = 'orders/' . $order->id . '/background_certificate' . '/';
        Storage::putFileAs($fileLocation, $file, $fileName);

        $insert_data = [];

        foreach ($participants as $participant) {
            $insert_data[] = [
                'order_id' => $order->id,
                'participant_id' => $participant->participant_id,
                'bg_image' => $fileLocation . $fileName,
                'template' => $request->template
            ];
        }

        $insert_data = collect($insert_data);

        $chunks = $insert_data->chunk(500);

        foreach ($chunks as $chunk) {
            DB::transaction(function () use ($chunk) {
                DB::table('certificates')->insert($chunk->toArray());
            });
        }





        // return response()->json($file->getClientOriginalName());
        // $request->validate([]);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $training = Training::find($order->training_id);
        return view('document.certificate', compact('order', 'training'));

        $pdf = PDF::loadView('document.certificate', compact('order', 'training'));

        return $pdf->download('cert.pdf');
    }

    public function certificateSettings($id)
    {
        $training = Training::findOrFail($id);

        if (!CertificateSetting::where('training_id', '=', $id)->first()) {
            DB::transaction(function () use ($id) {
                CertificateSetting::create([
                    'training_id' => $id
                ]);
            });
        }

        $certificate = CertificateSetting::where('training_id', '=', $id)->first();

        return view('admin.pages.certificate.new-setting')
            ->with(compact('certificate', 'training'));
    }

    public function storeCertificateSettings(StoreCertificateSettingsRequest $request)
    {
        $request = $request->validated();
        $training = Training::findOrFail($request['training_id']);
        $certificate_settings = CertificateSetting::findOrFail($request['id']);

        $file = $request['file'];
        $fileName = $file->getClientOriginalName();
        $fileLocation = 'trainings/certificate' . '/' . $training['id'] . '/';
        Storage::putFileAs($fileLocation, $file, $fileName);
        $certificate_settings->update([
            'file' => $fileLocation . $fileName
        ]);

        return redirect()->to(route('admin.training_index'))->with('success', 'Pengaturan sertifikat berhasil diubah');
    }
}
