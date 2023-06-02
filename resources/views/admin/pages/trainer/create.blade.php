<x-layout>
    @push('page_css')
        <link rel="stylesheet" href="{{ asset('vendor/quill/quill.snow.css') }}" />
    @endpush

    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">New Trainer</h1>
        </div>
    </x-slot:title>

    <form action="{{ route('admin.store_new_trainer') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="mb-3">Trainer Detail</h4>
                        <div class="form-group">
                            <label for="trainerName">Name</label>
                            <input name="name" type="text" class="form-control" id="trainerName">
                        </div>
                        <div class="form-group">
                            <label for="trainerEmail">Email</label>
                            <input name="email" type="text" class="form-control" id="trainerEmail">
                        </div>
                        <div class="form-group">
                            <label for="trainerJob">Job</label>
                            <input name="job" type="text" class="form-control" id="trainerJob">
                        </div>
                        <div class="form-group">
                            <label for="trainerDescription">Description</label>
                            <textarea name="description" id="trainerDescription" cols="30" rows="10"
                                class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success btn-block">Save</button>
            </div>
        </div>
    </form>

    @push('page_js')

        <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
        <script>
            var quill = new Quill('#editor-container', {
                modules: {
                    formula: false,
                    syntax: false,
                    toolbar: '#toolbar-container'
                },
                placeholder: 'Compose an epic...',
                theme: 'snow'
            });

        </script>
    @endpush
</x-layout>
