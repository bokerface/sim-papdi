<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function preview(Request $request)
    {
        $file = $request->file('background');

        return response()->json($file->getClientOriginalName());
        // $request->validate([]);
    }
}
