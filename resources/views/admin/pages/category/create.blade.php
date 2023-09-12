<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kategori Baru</h1>
        </div>
    </x-slot:title>

    <form action="{{ route('admin.store_new_category') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="mb-3">Detail Kategori</h4>
                        <div class="form-group">
                            <label for="categoryName">Name</label>
                            <input name="name" type="text" class="form-control" id="categoryName"
                                value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="categoryDescription">Description</label>
                            <textarea name="description" id="categoryDescription" cols="30" rows="10"
                                class="form-control">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success btn-block">Save</button>
            </div>
        </div>
    </form>
</x-layout>
