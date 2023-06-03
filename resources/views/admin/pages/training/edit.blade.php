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
            <h1 class="h3 mb-0 text-gray-800">Edit Training</h1>
        </div>
    </x-slot:title>

    <form class="row mb-3" action="{{ route('admin.update_training',$training->id) }}"
        method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Training Detail</h4>
                    <div class="form-group">
                        <label for="trainingName">Training Name</label>
                        <input name="name" type="text"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            id="trainingName" aria-describedby="name" value="{{ $training->name }}">
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
                        <label for="trainingDescription">Description</label>
                        <textarea name="description"
                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            id="trainingDescription" rows="3">{{ $training->description }}</textarea>
                        <small class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="trainingPlace">Place</label>
                        <input name="place" type="text"
                            class="form-control {{ $errors->has('place') ? 'is-invalid' : '' }}"
                            id="trainingPlace" aria-describedby="place" value="{{ $training->place }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('place') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="trainingType">Type</label>
                        <select name="type"
                            class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}"
                            id="">
                            <option value="">training type</option>
                            @foreach($types as $type)
                                <option value="{{ $type->value }}"
                                    {{ $training->type == $type->value ? 'selected' : '' }}>
                                    {{ $type->value }}
                                </option>
                            @endforeach
                        </select>
                        <small class="invalid-feedback">
                            {{ $errors->first('type') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="trainingQuota">Quota</label>
                        <input name="quota" type="number"
                            class="form-control {{ $errors->has('quota') ? 'is-invalid' : '' }}"
                            id="trainingQuota" aria-describedby="quota" value="{{ $training->quota }}">
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
                    <h4 class="mb-3">Date</h4>
                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input name="start_date" type="datetime-local"
                            class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                            id="startDate" value="{{ $training->start_date }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('start_date') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input name="end_date" type="datetime-local"
                            class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                            id="endDate" value="{{ $training->end_date }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('end_date') }}
                        </small>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Trainer</h4>
                    <div class="form-group">
                        <label for="trainerName">Search by trainer name</label>
                        <select class="js-example-basic-single form-control" name="trainer_id">
                        </select>
                        @error('trainer_id')
                            <small class="text-danger">
                                {{ $errors->first('trainer_id') }}
                            </small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="mb-3">Pricing</h4>
                    <div class="form-group">
                        <label for="earlyBirdPrice">Early Bird</label>
                        <input name="price_earlybird" type="number"
                            class="form-control {{ $errors->has('price_earlybird') ? 'is-invalid' : '' }}"
                            id="earlyBirdPrice" aria-describedby="earlyBird" value="{{ $training->price_earlybird }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('price_earlybird') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="startDate">Early Bird selesai</label>
                        <input name="earlybird_end" type="date"
                            class="form-control {{ $errors->has('earlybird_end') ? 'is-invalid' : '' }}"
                            id="startDate" value="{{ $training->earlybird_end }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('earlybird_end') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="NormalPrice">Normal</label>
                        <input name="price_normal" type="number"
                            class="form-control {{ $errors->has('price_normal') ? 'is-invalid' : '' }}"
                            id="NormalPrice" aria-describedby="normalPrice" value="{{ $training->price_earlybird }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('price_normal') }}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="studentPrice">Onsite</label>
                        <input name="price_onsite" type="number"
                            class="form-control {{ $errors->has('price_onsite') ? 'is-invalid' : '' }}"
                            id="studentPrice" aria-describedby="studentPrice"
                            value="{{ $training->price_earlybird }}">
                        <small class="invalid-feedback">
                            {{ $errors->first('price_onsite') }}
                        </small>
                    </div>
                </div>
            </div>

            <button class="btn btn-success btn-block">Save</button>
        </div>
    </form>

    @push('page_js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.js-example-basic-single').select2({
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
                $('.js-example-basic-single').html("<option value='" +
                    "{{ $training->trainers()->first()->id }}" + "' selected>" +
                    "{{ $training->trainers()->first()->name }}" + "</option>");
            });

        </script>
    @endpush
</x-layout>
