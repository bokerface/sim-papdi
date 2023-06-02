<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TrainingTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrainingRequest;
use App\Http\Requests\Admin\UpdateTrainingRequest;
use App\Models\Training;
use App\Services\TrainingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrainingController extends Controller
{

    public function index(): View
    {
        $trainings = Training::all();

        return view('admin.pages.training.index')
            ->with(compact('trainings'));
    }

    public function create(): View
    {
        $types = TrainingTypeEnum::cases();
        return view('admin.pages.training.create')
            ->with(compact('types'));
    }

    public function store(StoreTrainingRequest $request): RedirectResponse
    {
        TrainingService::storeTraining($request->validated());
        return redirect()->back();
    }

    public function edit($id): View
    {
        $training = Training::find($id);
        $types = TrainingTypeEnum::cases();
        return view('admin.pages.training.edit')
            ->with(compact([
                'types',
                'training'
            ]));
    }

    public function update(UpdateTrainingRequest $request, $id): RedirectResponse
    {
        TrainingService::getTrainingById($id)->updateTraining($request->validated());
        return redirect()->back();
    }
}
