<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Peserta Pelatihan</h1>
        </div>
    </x-slot:title>

    <div class="card">
        <div class="card-body">
            <form method="POST"
                action="{{ route('admin.store_training_participant',$training->id) }}">
                @csrf
                <input type="hidden" name="training_id" value="{{ $training->id }}">
                <div class="form-group row">
                    <label for="fullname" class="col-sm-2 col-form-label">Fullname</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control {{ $errors->has('fullname') ? 'is-invalid' : '' }}"
                            id="fullname" name="fullname">
                        <small class="invalid-feedback">
                            {{ $errors->first('fullname') }}
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            id="email" name="email">
                        <small class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="agency" class="col-sm-2 col-form-label">Instansi</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control {{ $errors->has('agency') ? 'is-invalid' : '' }}"
                            id="agency" name="agency">
                        <small class="invalid-feedback">
                            {{ $errors->first('agency') }}
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-layout>
