<x-layout>

    @push('page_css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
            integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Training Baru</h1>
        </div>
    </x-slot:title>

    <form class="row mb-3" action="{{ route('admin.store_new_training') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Detail Training</h4>
                    <div class="form-group">
                        <label for="trainingName">Nama Training</label>
                        <input name="name" type="text"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            id="trainingName" aria-describedby="name" value="{{ old('name') }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="trainingName">Banner Training</label>
                        <input name="image" type="file"
                            class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                            id="trainingImage" value="{{ old('image') }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="trainingDescription">Deskripsi</label>
                        <textarea name="description"
                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            id="trainingDescription" rows="3">{{ old('description') }}</textarea>
                        <small class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="trainingPlace">Tempat</label>
                        <input name="place" type="text"
                            class="form-control {{ $errors->has('place') ? 'is-invalid' : '' }}"
                            id="trainingPlace" aria-describedby="place" value="{{ old('place') }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('place') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="trainingType">Tipe Training</label>
                        <select name="type"
                            class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}"
                            id="">
                            <option value="">tipe training</option>
                            @foreach($types as $type)
                                <option value="{{ $type->value }}"
                                    {{ old('type') == $type->value ? 'selected' : '' }}>
                                    {{ $type->value }}
                                </option>
                            @endforeach
                        </select>
                        <small class="invalid-feedback">
                            {{ $errors->first('type') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="trainingQuota">Kuota</label>
                        <input name="quota" type="number"
                            class="form-control {{ $errors->has('quota') ? 'is-invalid' : '' }}"
                            id="trainingQuota" aria-describedby="quota" value="{{ old('quota') }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('quota') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="mb-3">Tanggal</h4>
                    <div class="form-group">
                        <label for="startDate">Tanggal Mulai</label>
                        <input name="start_date" type="datetime-local"
                            class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                            id="startDate" value="{{ old('start_date') }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('start_date') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="endDate">Tanggal Selesai</label>
                        <input name="end_date" type="datetime-local"
                            class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                            id="endDate" value="{{ old('end_date') }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('end_date') }}
                        </small>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="mb-3">Pemateri</h4>
                    <div class="form-group">
                        <label for="trainerName">Cari berdasarkan nama pemateri</label>
                        <select class="form-control" name="trainer_id" id="select_trainer">
                        </select>
                        @error('trainer_id')
                            <small class="text-danger">
                                {{ $errors->first('trainer_id') }}
                            </small>
                        @enderror
                    </div>
                    <p>atau</p>
                    <a href="{{ route('admin.create_new_trainer') }}" target="_blank"
                        class="btn btn-primary">
                        Tambah pemateri baru
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Kategori</h4>
                    <div class="form-group">
                        <label for="categoryName">Cari berdasarkan nama kategori</label>
                        <select class="form-control" name="category_id" id="select_category">
                        </select>
                        @error('category_id')
                            <small class="text-danger">
                                {{ $errors->first('category_id') }}
                            </small>
                        @enderror
                    </div>
                    <p>atau</p>
                    <a href="{{ route('admin.create_new_category') }}" target="_blank"
                        class="btn btn-primary">
                        Tambah kategori baru
                    </a>
                </div>
            </div>
        </div>
        <div class="col-4">

            <div class="card mb-3" id="price-card">
                <div class="card-body">
                    <h4 class="mb-3">Harga</h4>
                    <div class="form-group">
                        <label for="earlyBirdPrice">Early Bird</label>
                        <input name="price_earlybird" type="text"
                            class="form-control {{ $errors->has('price_earlybird') ? 'is-invalid' : '' }}"
                            id="earlyBirdPrice" value="{{ old('price_earlybird') }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('price_earlybird') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="startDate">Early Bird selesai</label>
                        <input name="earlybird_end" type="date"
                            class="form-control {{ $errors->has('earlybird_end') ? 'is-invalid' : '' }}"
                            id="startDate" value="{{ old('earlybird_end') }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('earlybird_end') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="NormalPrice">Normal</label>
                        <input name="price_normal" type="text"
                            class="form-control {{ $errors->has('price_normal') ? 'is-invalid' : '' }}"
                            id="NormalPrice" value="{{ old('price_normal') }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('price_normal') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="studentPrice">Onsite</label>
                        <input name="price_onsite" type="text"
                            class="form-control {{ $errors->has('price_onsite') ? 'is-invalid' : '' }}"
                            id="studentPrice" value="{{ old('price_onsite') }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('price_onsite') }}
                        </small>
                    </div>
                </div>
            </div>

            <button class="btn btn-success btn-block">Simpan</button>
        </div>
    </form>

    @push('page_js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#select_trainer').select2({
                    theme: "bootstrap",
                    ajax: {
                        url: "{{ route('admin.get_trainer_by_name') }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            console.log(data);
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            });

        </script>

        <script>
            $(document).ready(function () {
                $('#select_category').select2({
                    theme: "bootstrap",
                    ajax: {
                        url: "{{ route('admin.get_trainer_by_name') }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            console.log(data);
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            });

        </script>

        <script>
            $(document).ready(function () {
                $('#select_category').select2({
                    theme: "bootstrap",
                    ajax: {
                        url: "{{ route('admin.get_category_by_name') }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            console.log(data);
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            });

        </script>

        @if(old('trainer_id')!=null)
            <script>
                const trainer_id = "{{ old('trainer_id') }}";
                const trainer_name =
                    "{{ App\Models\Trainer::find(old('trainer_id'))->name }}";
                $("#select_trainer").html('<option value="' + trainer_id + '" selected>' + trainer_name +
                    '</option>');

            </script>
        @endif

        @if(old('category_id')!=null)
            <script>
                const category_id = "{{ old('category_id') }}";
                const category_name =
                    "{{ App\Models\Category::find(old('category_id'))->name }}";
                $("#select_category").html('<option value="' + category_id + '" selected>' + category_name +
                    '</option>');

            </script>
        @endif

    @endpush
</x-layout>
