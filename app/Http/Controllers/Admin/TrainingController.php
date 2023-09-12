<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TrainingTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrainingRequest;
use App\Http\Requests\Admin\UpdateTrainingRequest;
use App\Http\Requests\StoreUrgentParticipant;
use App\Models\Training;
use App\Models\UrgentParticipant;
use App\Services\TrainingService;
use Illuminate\Http\RedirectResponse;
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
        return redirect()->to(route('admin.training_index'))->with('success', 'Pelatihan berhasil ditambahkan.');
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

    public function participantIndex($id)
    {
        $training = Training::findOrFail($id);
        $participants = UrgentParticipant::where('training_id', '=', $id)->get();
        return view('admin.pages.training.training-participant')
            ->with(compact([
                'participants',
                'training'
            ]));
    }

    public function addParticipant($id)
    {
        $training = Training::findOrFail($id);
        return view('admin.pages.training.add-training-participant')
            ->with(compact([
                'training'
            ]));
    }

    public function storeParticipant($id, StoreUrgentParticipant $request)
    {
        Training::findOrFail($id);
        TrainingService::storeUrgentTrainingParticipant($request->validated());
        return redirect()->to(route('admin.training_participant', $id))->with('success', 'Peserta pelatihan baru ditambahkan.');
    }

    public function deleteTrainingParticipant($id, $participant_id)
    {
        UrgentParticipant::findOrFail($participant_id);
        TrainingService::deleteUrgentTrainingParticipant($participant_id);
        return redirect()->to(route('admin.training_participant', $id))->with('success', 'Peserta pelatihan dihapus.');
    }
}
