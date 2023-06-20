<x-user.layout>
    <section class="py-5" id="features">
        <div class="container px-5 my-5 d-flex justify-content-center">
            <div class="col-5">
                <h4 class="card-title">
                    Reset Password
                </h4>
                <form action="{{ route('user.reset_password_attempt') }}" method="POST" class="mt-5">
                    @error('login_failed')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword"
                            placeholder="Password">
                    </div>
                    <div class="mb-5">
                        <label for="inputPassword" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            id="inputPasswordConfirmation" placeholder="Konfirmasi Password">
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
