<x-user.layout>
    <section class="py-5" id="features">
        <div class="container px-5 my-5 d-flex justify-content-center">
            <div class="col-5">
                <h4 class="card-title">
                    Pendaftaran Akun Baru
                </h4>
                <form action="{{ route('user.submit_registration') }}" method="POST" class="mt-5">
                    @csrf
                    <div class="mb-4">
                        <label for="inputEmail" class="form-label">Alamat Email</label>
                        <input type="email" name="email"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            id="inputEmail" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="inputFullname" class="form-label">Nama Lengkap</label>
                        <input type="text" name="fullname"
                            class="form-control {{ $errors->has('fullname') ? 'is-invalid' : '' }}"
                            id="inputFullname" placeholder="Nama Lengkap"
                            value="{{ old('fullname') }}">
                        @error('fullname')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="inputUserName" class="form-label">Nama Pengguna</label>
                        <input type="text" name="username"
                            class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                            id="inputUserName" placeholder="Nama Pengguna"
                            value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="inputPhone" class="form-label">Nomor Telepon</label>
                        <input type="text" name="phone"
                            class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                            id="inputPhone" placeholder="Nomor Telepon" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="inputPhone" class="form-label">Instansi</label>
                        <input type="text" name="agency"
                            class="form-control {{ $errors->has('agency') ? 'is-invalid' : '' }}"
                            id="inputPhone" placeholder="Instansi" value="{{ old('agency') }}">
                        @error('agency')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" name="password"
                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            id="inputPassword" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="inputPasswordConfirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            id="inputPasswordConfirmation" placeholder="Konfirmasi Password">
                    </div>
                    <div class="mb-5 d-flex flex-column">
                        <a href="{{ route('user.login_form') }}" class="mb-3">Login</a>
                        <a href="">Forgot Password</a>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-primary btn-block">
                            Daftar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </section>
</x-user.layout>
