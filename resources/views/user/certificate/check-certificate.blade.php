<x-user.layout>
    <div class="col-12">
        <section class="py-5" id="features">
            <div class="container px-5 my-5 d-flex justify-content-center">
                <div class="col-5">
                    <h4 class="card-title">
                        Cek Sertifikat
                    </h4>
                    <form action="{{ route('user.select_certificate') }}" method="get" class="mt-5">
                        @error('email_doesnt_exists')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        @csrf
                        <div class="mb-4">
                            <label for="inputEmail" class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block">
                                Cek
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </div>
</x-user.layout>
