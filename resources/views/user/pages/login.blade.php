<x-user.layout>
    <section class="py-5" id="features">
        <div class="container px-5 my-5 d-flex justify-content-center">
            <div class="col-5">
                <h4 class="card-title">
                    Login
                </h4>
                <form action="{{ route('user.login_attempt') }}" method="POST" class="mt-5">
                    @error('login_failed')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    @csrf
                    <div class="mb-4">
                        <label for="inputEmail" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                    <div class="mb-5">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword"
                            placeholder="Password">
                    </div>
                    <div class="mb-5 d-flex flex-column">
                        <a href="{{ route('user.registration_form') }}" class="mb-3">
                            Register An Account
                        </a>
                        <a href="">Forgot Password</a>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block">
                            Login
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </section>
</x-user.layout>
