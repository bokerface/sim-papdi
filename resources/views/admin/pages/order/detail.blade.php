<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Status Pembayaran</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
            </a> --}}
        </div>
    </x-slot:title>

    <div class="col-12">
        <section id="features">
            <div class="container my-5">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-6">
                            <h5>Keterangan</h5>
                            <h6 class="text-secondary">
                                ID Pendaftaran :
                                {{ $data['order']['id'] }}
                            </h6>
                            <div class="my-3 d-flex">
                                <div class="mr-3">
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
                                                <span class="text-dark">
                                                    {{ $participant['fullname'] }}
                                                </span><br>
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
                            <h5 class="text-dark">
                                <b>Detail Pembayaran</b>
                            </h5>
                            <div class="card bg-light">
                                <div class="card-body bg-light">
                                    <h6 class="d-flex align-items-center">
                                        Status Pembayaran :
                                        @if(
                                            $data['order']['status'] == "Lunas")
                                            <span class="badge badge-success ml-1">Lunas</span>
                                        @elseif(
                                            $data['order']['status'] == "Expired")
                                            <span class="badge badge-danger ml-1">Expired</span>
                                        @else
                                            <span class="badge badge-warning ml-1">Menunggu Pembayaran</span>
                                        @endif
                                    </h6>
                                </div>
                            </div>
                            <h5 class="mt-3 text-dark"><b>Nominal Pembayaran</b></h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-secondary">
                                        Rp. {{ $data['totalPrice'] }}
                                    </h6>
                                </div>
                            </div>
                            @if(
                                $data['order']['status_order'] == "")
                                <h5 class="mt-3 text-dark">
                                    <b>Konfirmasi Pembayaran</b>
                                </h5>
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <a href="{{ route('admin.finish_order',$data['order']['id']) }}"
                                            class="btn btn-success">
                                            Pembayaran sudah diterima
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <a href="{{ route('admin.certificate_setting_detail',$data['order']['id']) }}"
                                class="btn btn-block btn-primary mt-3">
                                Sertifikat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


</x-layout>
