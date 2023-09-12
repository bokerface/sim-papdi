<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function trainingBanner(Request $request)
    {
        $validated = $request->validate([
            'q' => 'string'
        ]);

        if (empty($validated['q'])) {
            abort(404);
        }

        $filePath = Crypt::decryptString($validated['q']);

        if (Storage::exists($filePath)) {
            $content = Storage::get($filePath);
            if ($content != null) {
                $mime = Storage::mimeType($content);
                $response = Response::make($content, 200);
                $response->header("Content-Type", $mime);
                return $response;
            }
            abort(404);
        } else {
            abort(404);
        }
    }

    public function certificateBackground(Request $request)
    {
        $validated = $request->validate([
            'q' => 'string'
        ]);

        if (empty($validated['q'])) {
            abort(404);
        }

        $filePath = Crypt::decryptString($validated['q']);

        if (Storage::exists($filePath)) {
            $content = Storage::get($filePath);
            if ($content != null) {
                $mime = Storage::mimeType($content);
                $response = Response::make($content, 200);
                $response->header("Content-Type", $mime);
                return $response;
            }
            abort(404);
        } else {
            abort(404);
        }
    }
}
