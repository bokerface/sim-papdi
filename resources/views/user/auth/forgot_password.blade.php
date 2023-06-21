<x-user.layout>
    <section class="py-5" id="features">
        <div class="container px-5 my-5 d-flex justify-content-center">
            <div class="col-5">
                <h4>
                    Lupa Password
                </h4>

                <form action="{{ route('user.send_reset_password_form') }}" method="POST"
                    class="mt-5">
                    @if(session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    @error('login_failed')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    @csrf
                    <div class="mb-4">
                        <label for="inputEmail" class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                    <div class="mb-5 d-flex flex-column">
                        <a href="{{ route('user.registration_form') }}" class="mb-3">
                            Daftar Akun Baru
                        </a>
                        <a href="{{ route('user.login_form') }}">Login</a>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block">
                            Submit
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </section>
</x-user.layout>
