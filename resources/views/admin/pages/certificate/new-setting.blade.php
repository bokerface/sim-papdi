<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pengaturan Template Sertifikat</h1>
        </div>
    </x-slot:title>

    <div class="col-6 mx-auto">
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('admin.store_certificate_settings',$training->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <label>Background</label>
                    <input type="hidden" name="training_id" value="{{ $training->id }}">
                    <input type="hidden" name="id" value="{{ $certificate->id }}">
                    <input type="file" name="file"
                        class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}">
                    <small class="invalid-feedback">
                        {{ $errors->first('file') }}
                    </small>
                    <button type="submit" class="btn btn-primary btn-sm btn-block mt-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
