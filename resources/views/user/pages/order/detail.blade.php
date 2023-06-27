<x-user.layout>
    <div class="col-12">
        <section class="py-5" id="features">
            <div class="container px-5 my-5">
                <h4>Status Pembayaran</h4>
                <div class="card">
                    <div class="card-body row">
                        <div class="col-6">
                            <h5>Keterangan</h5>
                            <h6 class="text-secondary">
                                ID Pendaftaran :
                                {{ $data['order']['id'] }}
                            </h6>
                            <div class="my-3 d-flex">
                                <div class="me-3">
                                    <img src="{{ route('training.image').'?q='.$data['training']['image'] }}"
                                        class="rounded img-thumbnail" style="max-width: 150px" alt="...">
                                </div>
                                <div>
                                    <span><b>{{ $data['training']['name'] }}</b></span>
                                    <p class="text-secondary">
                                        Rp. {{ $data['trainingPrice'] }}
                                    </p>
                                </div>
                            </div>
                            <h6>Jumlah Peserta : {{ $data['numberOfParticipants'] }}</h6>
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush" style="max-height: 250px;margin-bottom: 10px; overflow-y:auto;
                                        -webkit-overflow-scrolling: touch;">

                                        @foreach(
                                            $data['participants'] as $participant)
                                            <li class="list-group-item">
                                                <span>{{ $participant['fullname'] }}</span><br>
                                                <span class="text-secondary">
                                                    {{ $participant['email'] }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5><b>Detail Pembayaran</b></h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-secondary">
                                        Status Pembayaran
                                        :
                                        <x-user.order-status :id="$data['order']['id']" />
                                    </h6>
                                </div>
                            </div>
                            <h5 class="mt-3"><b>Nominal Pembayaran</b></h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-secondary">
                                        Rp. {{ $data['totalPrice'] }}
                                    </h6>
                                </div>
                            </div>
                            <h5 class="mt-3"><b>Alamat Pembayaran</b></h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-secondary">
                                        04820-23424-23425-456
                                    </h6>
                                </div>
                            </div>
                            <h5 class="mt-3"><b>Konfirmasi Pembayaran</b></h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <span class="text-secondary">
                                        kirimkan bukti pembayaran ke nomor :
                                    </span>
                                    <h6 class="text-secondary">
                                        04820-23424-23425-456
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-user.layout>
