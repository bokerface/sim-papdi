<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pengaturan Template Sertifikat</h1>
        </div>
    </x-slot:title>

    @foreach($trainings as $training)
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-2 mr-3">
                        <img src="{{ route('training.image').'?q='.$training->image }}"
                            width="200" alt="">
                    </div>
                    <div class="col-8">
                        <div class="mb-2">
                            <h5 class="font-weight-bold">
                                <a class="stretched-link"
                                    href="{{ route('admin.certificate_setting_detail',$training->id) }}">
                                    {{ $training->name }}
                                </a>
                            </h5>
                        </div>
                        <p>
                            {{ $training->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</x-layout>
