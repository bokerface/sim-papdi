<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrainerRequest;
use App\Models\Trainer;
use App\Services\TrainerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrainerController extends Controller
{
    public function index()
    {
    }

    public function create(): View
    {
        return view('admin.pages.trainer.create');
    }

    public function store(StoreTrainerRequest $request): RedirectResponse
    {
        TrainerService::storeTrainer($request->validated());
        return redirect()->back();
    }

    public function trainerByName(Request $request): JsonResponse
    {
        $trainer = Trainer::when($request->has('q'), function ($q) use ($request) {
            $q->where('name', 'LIKE', "%{$request->q}%");
        })
            ->limit(10)
            ->get();

        return response()->json($trainer, 200);
    }
}
