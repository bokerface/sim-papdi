<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Trainings</h1>
            <a href="{{ route('admin.create_new_training') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Pelatihan Baru
            </a>
        </div>
    </x-slot:title>

    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    @foreach($trainings as $training)
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-2 mr-3">
                        @if($training->certificateSetting->file == null)
                            <img src="{{ route('training.image').'?q='.$training->image }}"
                                width="200" alt="">
                        @else
                            <img src="{{ route('uni.certificate_background_image') . '?q=' . $training->certificateSetting->file }}"
                                width="200" alt="">
                        @endif

                    </div>
                    <div class="col-8">
                        <div class="mb-2">
                            <h5 class="font-weight-bold">
                                <a href="{{ route('admin.edit_training',$training->id) }}">
                                    {{ $training->name }}
                                </a>
                            </h5>
                        </div>
                        <p>
                            {{ $training->description }}
                        </p>
                        <a href="{{ route('admin.training_participant',$training->id) }}"
                            class="btn btn-primary btn-sm">
                            Peserta
                        </a>
                        <a href="{{ route('admin.certificate_settings',$training->id) }}"
                            class="btn btn-warning btn-sm">
                            Pengaturan Sertifikat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</x-layout>
