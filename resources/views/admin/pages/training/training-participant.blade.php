<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Peserta Pelatihan</h1>
            <a href="{{ route('admin.add_training_participant',$training->id) }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Peserta
            </a>
        </div>
    </x-slot:title>

    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    @foreach($participants as $participant)
        <div class="card mb-2">
            <div class="card-body">
                <form
                    action="{{ route('admin.delete_training_participant',[$training->id,$participant->id]) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                        <div class="col-8">
                            <span>Nama Lengkap : {{ $participant->fullname }}</span>
                            <br>
                            <span>Email : {{ $participant->email }}</span>
                            <br>
                            <span>Instansi : {{ $participant->agency }}</span>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-danger btn-sm">
                                hapus
                            </button>
                            <a href="{{ route('user.download_certificate',[$participant->training_id,$participant->email]) }}"
                                class="btn btn-success btn-sm">sertifikat</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

</x-layout>
