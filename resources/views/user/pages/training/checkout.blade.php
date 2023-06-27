<x-user.layout>
    <form action="{{ route('user.order_training',$training->id) }}" method="POST">
        <div class="col-12">
            <section class="py-5" id="features">
                <div class="container px-5 my-5 d-flex">
                    @csrf
                    <input type="hidden" name="training_id" value="{{ $training->id }}">
                    <div class="col-9 me-3">
                        <h4>Data Peserta</h4>
                        @for($i = 1; $i <= $participant; $i++)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5>Peserta {{ $i }}</h5>
                                    <div class="mb-3">
                                        <small class="form-label text-secondary"><b>Nama lengkap</b></small>
                                        <input type="text" name="fullname[]" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <small class="form-label text-secondary"><b>Alamat Email</b></small>
                                        <input type="email" name="email[]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="col-3">
                        <h4>Detail Pembayaran</h4>
                        <div class="card">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td><span class="text-secondary">Harga Training</span></td>
                                        <td><span class="ms-3">Rp. {{ $price }}</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-secondary">Jumlah Peserta</span></td>
                                        <td><span class="ms-3">{{ $participant }} orang</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-secondary">Total</span></td>
                                        <td><span class="ms-3">Rp. {{ $totalPrice }}</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <select class="form-select form-select-sm mt-2" name="payment_method">
                            <option>Metode Pembayaran</option>
                            @foreach($paymentMethod as $method)
                                <option value="{{ $method->name }}">{{ $method->value }}</option>
                            @endforeach
                        </select>
                        <div class="d-grid gap-2 mt-2">
                            <button class="btn btn-primary" type="submit">Lanjutkan pembayaran</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </form>
</x-user.layout>
