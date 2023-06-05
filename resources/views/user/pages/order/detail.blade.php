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
                                ID Pemesanan : 1
                            </h6>
                            <div class="my-3 d-flex">
                                <div class="me-3">
                                    <img src="{{ route('training.image').'?q='.$training->image }}"
                                        class="rounded img-thumbnail" style="max-width: 150px" alt="...">
                                </div>
                                <div>
                                    <span><b>{{ $training->name }}</b></span>
                                    <p class="text-secondary">
                                        Rp. 900000
                                    </p>
                                </div>
                            </div>
                            <h6>Jumlah Peserta : 20</h6>
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush" style="max-height: 250px;margin-bottom: 10px; overflow-y:auto;
                                        -webkit-overflow-scrolling: touch;">
                                        <li class="list-group-item">An item</li>
                                        <li class="list-group-item">A second item</li>
                                        <li class="list-group-item">A third item</li>
                                        <li class="list-group-item">A fourth item</li>
                                        <li class="list-group-item">And a fifth one</li>
                                        <li class="list-group-item">And a fifth one</li>
                                        <li class="list-group-item">And a fifth one</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5><b>Detail Pembayaran</b></h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-secondary">
                                        Status Pembayaran : menunggu pembayaran
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-user.layout>
